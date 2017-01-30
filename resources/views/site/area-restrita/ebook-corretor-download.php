<?php
header("Content-type:application/pdf");
header("Content-Disposition:attachment;filename='Ebook_Leardi_Corretores.pdf'");
readfile(storage_path('app/Ebook_Leardi_Corretores.pdf'));