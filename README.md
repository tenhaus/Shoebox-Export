Shoebox-Export
==============

Command line Shoebox exporter for http://shoeboxapp.com


I wanted to export my photo collection from Shoebox, but I had over 33k photos, and there is a memory leak with their export application for mac.

I created this so I could pull my entire collection.

Visit https://secure.shoeboxapp.com/export to request your export.
They will email you a list of your photos. It will be called something like Shoebox-Export-2014-11-12.msbx

With that file, run php ShoeboxExporter.php Shoebox-Export-2014-11-12.msbx /tmp

And of course, replace the parameters with your export file, and the directory you want to save your photos to.

