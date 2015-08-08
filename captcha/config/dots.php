<?

// -------------------------------------------------------------------------------------
// Captcha Creator PHP Configuration File.
// Copyright (c) 2007 Alexandru Marias. All rights reserved
// Web: http://www.captchacreator.com
// Phone: +40722486348
// ----------------------------------------------------------------

// The font used, can be 1 if random chosed from a fonts directory or 0 if specified
$CFontUsed = 1; 
$CFontURL = 'font/gopad.ttf'; 

// The number of fonts in the font directory
$FontNo = 34; 
// The script will automatically chose a font between 1 and this value

// The fonts directory
$fonts_dir = 'fonts';

/* font size range, angle range, character padding */

// Everytime a captcha is shown, a new random code will be generated
// This code is a string of letters and numbers, and it's length can be chosen random as well

// The Code Minimum Length
$CMinSize = 4;  

// The Code Minimum Length
$CMaxSize = 5;  

// The Code Characters
$CSrc = 'abcdefghijkmnpqrstuvwxyz23456789';

// For example if the Minimum Length is 4 and Maximum Length is 5, Captcha Codes will
// sometimes be of 4 characters in length and sometimes of 5 characters in length

// Image Size can be either variable, random within some parameters, or fixed
$CSize = 1; // 1 is variable, 0 is fixed
$CSizeWidth = 0; 
$CSizeHeight = 0; // 1 is variable, 0 is fixed

// Background can be either random ( generated by the script ) or specified by a file
$CBackgroundType = 0; // 1 is random, 0 is fixed
$CBackgroundFile = 'backgrounds/9.gif'; // 1 is random, 0 is fixed
$CBackgroundFillType = 1; // 1 is tiled, 0 is resized

// Color of text
$CFontColorType = 3; // 1 is random, 2 is black, 3 is white

// The font can vary as well
$CFontSizeMin = 25;
$CFontSizeMax = 30;

// Leters and numbers inside the Captcha can be rotated
$CFontRotMin = -15;
$CFontRotMax = 15;

// The space around the characters
$CFontPadding = 2;

// The output type ( jpeg, png )
# $output_type='jpeg';
 $output_type='png';

// Captcha Type
 $captcha_type = 1;


 ?>
