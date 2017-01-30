<?php
header("Content-type:application/pdf");
header("Content-Disposition:attachment;filename='Ebook_Leardi_Franquia_Imobiliaria_voce_ja_pensou-nisso.pdf'");
readfile(storage_path('app/Ebook_Leardi_Franquia_Imobiliaria_voce_ja_pensou-nisso.pdf'));