WebP Express 0.19.0. Conversion triggered using bulk conversion, 2021-03-24 08:29:55

*WebP Convert 2.3.2*  ignited.
- PHP version: 7.4.14
- Server software: Apache

Stack converter ignited

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: D:\programming\OpenServer\domains\axe/wp-content/themes/axe/axe__/img/card__item/tab__description-1.png
- destination: D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/themes/axe\axe__\img\card__item\tab__description-1.png.webp
- log-call-arguments: true
- converters: (array of 10 items)

The following options have not been explicitly set, so using the following defaults:
- converter-options: (empty array)
- shuffle: false
- preferred-converters: (empty array)
- extra-converters: (empty array)

The following options were supplied and are passed on to the converters in the stack:
- alpha-quality: 80
- encoding: "auto"
- metadata: "none"
- near-lossless: 60
- quality: 85
------------


*Trying: cwebp* 

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: D:\programming\OpenServer\domains\axe/wp-content/themes/axe/axe__/img/card__item/tab__description-1.png
- destination: D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/themes/axe\axe__\img\card__item\tab__description-1.png.webp
- alpha-quality: 80
- encoding: "auto"
- low-memory: true
- log-call-arguments: true
- metadata: "none"
- method: 6
- near-lossless: 60
- quality: 85
- use-nice: true
- command-line-options: ""
- try-common-system-paths: true
- try-supplied-binary-for-os: true

The following options have not been explicitly set, so using the following defaults:
- auto-filter: false
- default-quality: 85
- max-quality: 85
- preset: "none"
- size-in-percentage: null (not set)
- skip: false
- rel-path-to-precompiled-binaries: *****
- try-cwebp: true
- try-discovering-cwebp: true
------------

Encoding is set to auto - converting to both lossless and lossy and selecting the smallest file

Converting to lossy
Looking for cwebp binaries.
Discovering if a plain cwebp call works (to skip this step, disable the "try-cwebp" option)
- Executing: cwebp -version 2>&1. Result: *Exec failed* (return code: 1)

*Output:* 
'cwebp' is not recognized as an internal or external command,
operable program or batch file.

Nope a plain cwebp call does not work
Discovering binaries using "which -a cwebp" command. (to skip this step, disable the "try-discovering-cwebp" option)
Found 0 binaries
Discovering binaries by peeking in common system paths (to skip this step, disable the "try-common-system-paths" option)
Found 0 binaries
Discovering binaries which are distributed with the webp-convert library (to skip this step, disable the "try-supplied-binary-for-os" option)
Checking if we have a supplied precompiled binary for your OS (WINNT)... We do.
Found 1 binaries: 
- D:\programming\OpenServer\domains\axe\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe
Detecting versions of the cwebp binaries found
- Executing: D:\programming\OpenServer\domains\axe\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe -version 2>&1. Result: version: *1.1.0*
Binaries ordered by version number.
- D:\programming\OpenServer\domains\axe\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe: (version: 1.1.0)
Trying the first of these. If that should fail (it should not), the next will be tried and so on.
Creating command line options for version: 1.1.0
Quality: 85. 
The near-lossless option ignored for lossy
Trying to convert by executing the following command:
D:\programming\OpenServer\domains\axe\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe -metadata none -q 85 -alpha_q "80" -m 6 -low_memory "D:\programming\OpenServer\domains\axe/wp-content/themes/axe/axe__/img/card__item/tab__description-1.png" -o "D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/themes/axe\axe__\img\card__item\tab__description-1.png.webp.lossy.webp" 2>&1 2>&1

*Output:* 
Saving file 'D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/themes/axe\axe__\img\card__item\tab__description-1.png.webp.lossy.webp'
File:      D:\programming\OpenServer\domains\axe/wp-content/themes/axe/axe__/img/card__item/tab__description-1.png
Dimension: 477 x 289 (with alpha)
Output:    11196 bytes Y-U-V-All-PSNR 43.99 48.23 48.11   44.99 dB
           (0.65 bpp)
block count:  intra4:        367  (64.39%)
              intra16:       203  (35.61%)
              skipped:       117  (20.53%)
bytes used:  header:            170  (1.5%)
             mode-partition:   1758  (15.7%)
             transparency:       50 (99.0 dB)
 Residuals bytes  |segment 1|segment 2|segment 3|segment 4|  total
  intra4-coeffs:  |    6436 |     199 |     206 |     203 |    7044  (62.9%)
 intra16-coeffs:  |     248 |      19 |      14 |      73 |     354  (3.2%)
  chroma coeffs:  |    1373 |      57 |      86 |     250 |    1766  (15.8%)
    macroblocks:  |      61%|       4%|       6%|      29%|     570
      quantizer:  |      18 |      13 |       9 |       8 |
   filter level:  |      63 |       3 |       2 |       0 |
------------------+---------+---------+---------+---------+-----------------
 segments total:  |    8057 |     275 |     306 |     526 |    9164  (81.9%)
Lossless-alpha compressed size: 49 bytes
  * Header size: 29 bytes, image data size: 20
  * Lossless features used: PALETTE
  * Precision Bits: histogram=3 transform=3 cache=0
  * Palette size:   4

Success
Reduction: 92% (went from 141 kb to 11 kb)

Converting to lossless
Looking for cwebp binaries.
Discovering if a plain cwebp call works (to skip this step, disable the "try-cwebp" option)
- Executing: cwebp -version 2>&1. Result: *Exec failed* (return code: 1)

*Output:* 
'cwebp' is not recognized as an internal or external command,
operable program or batch file.

Nope a plain cwebp call does not work
Discovering binaries using "which -a cwebp" command. (to skip this step, disable the "try-discovering-cwebp" option)
Found 0 binaries
Discovering binaries by peeking in common system paths (to skip this step, disable the "try-common-system-paths" option)
Found 0 binaries
Discovering binaries which are distributed with the webp-convert library (to skip this step, disable the "try-supplied-binary-for-os" option)
Checking if we have a supplied precompiled binary for your OS (WINNT)... We do.
Found 1 binaries: 
- D:\programming\OpenServer\domains\axe\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe
Detecting versions of the cwebp binaries found
- Executing: D:\programming\OpenServer\domains\axe\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe -version 2>&1. Result: version: *1.1.0*
Binaries ordered by version number.
- D:\programming\OpenServer\domains\axe\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe: (version: 1.1.0)
Trying the first of these. If that should fail (it should not), the next will be tried and so on.
Creating command line options for version: 1.1.0
Trying to convert by executing the following command:
D:\programming\OpenServer\domains\axe\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe -metadata none -q 85 -alpha_q "80" -near_lossless 60 -m 6 -low_memory "D:\programming\OpenServer\domains\axe/wp-content/themes/axe/axe__/img/card__item/tab__description-1.png" -o "D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/themes/axe\axe__\img\card__item\tab__description-1.png.webp.lossless.webp" 2>&1 2>&1

*Output:* 
Saving file 'D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/themes/axe\axe__\img\card__item\tab__description-1.png.webp.lossless.webp'
File:      D:\programming\OpenServer\domains\axe/wp-content/themes/axe/axe__/img/card__item/tab__description-1.png
Dimension: 477 x 289
Output:    63936 bytes (3.71 bpp)
Lossless-ARGB compressed size: 63936 bytes
  * Header size: 2926 bytes, image data size: 60984
  * Lossless features used: PREDICTION CROSS-COLOR-TRANSFORM SUBTRACT-GREEN
  * Precision Bits: histogram=3 transform=3 cache=10

Success
Reduction: 56% (went from 141 kb to 62 kb)

Picking lossy
cwebp succeeded :)

Converted image in 1583 ms, reducing file size with 92% (went from 141 kb to 11 kb)
