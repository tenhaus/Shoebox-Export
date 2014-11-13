<?php

if(count($argv) < 3)
{
  echo "Usage: php ShoeboxExporter.php <export file> <directory to save to>\n";
  return;
}
else
{
  $exportData = $argv[1];
  $outputDirectory = $argv[2];

  $exporter = new ShoeboxExporter();
  $exporter->export($exportData, $outputDirectory);

}

class ShoeboxExporter
{

  public function export($exportFile, $outputDirectory)
  {
    $directoryPrefix = "ShoeboxExport";
    $exportData = file($exportFile);
    $count = count($exportData);

    for($i=0; $i<$count; $i++)
    {
      $lineItem = $exportData[$i];

      $directory  = $outputDirectory . '/' . $directoryPrefix . '/';
      $directory .= $this->directoryFor($lineItem) . '/';

      $fileName = $this->fileNameFor($lineItem);
      $fileSize = $this->fileSizeFor($lineItem);
      $url = $this->urlFor($lineItem);

      $this->download($fileName, $fileSize, $directory, $url, $i, $count);
    }
  }

  private function download($fileName, $fileSize, $directory, $url, $index, $total)
  {
    $fullPath = $directory . $fileName;
    echo '(' . ($index+1) . ' of ' . $total . ') ' . $fullPath . ' ';

    if(!file_exists($directory)) mkdir($directory, 0755, true);
    if(file_exists($fullPath))
    {
      echo "Skipping\n";
    }
    else
    {
      $data = file_get_contents($url);
      file_put_contents($fullPath, $data);
      echo "Done\n";
    }
  }

  private function directoryFor($lineItem)
  {
    $lineParts = explode(',', $lineItem);
    $fileParts = explode('/', $lineParts[0]);
    return $fileParts[0];
  }

  private function fileNameFor($lineItem)
  {
    $lineParts = explode(',', $lineItem);
    $fileParts = explode('/', $lineParts[0]);
    return $fileParts[1];
  }

  private function urlFor($lineItem)
  {
    $lineParts = explode(',', $lineItem);
    return $lineParts[2];
  }

  private function fileSizeFor($lineItem)
  {
    $lineParts = explode(',', $lineItem);
    return $lineParts[1];
  }
}

?>
