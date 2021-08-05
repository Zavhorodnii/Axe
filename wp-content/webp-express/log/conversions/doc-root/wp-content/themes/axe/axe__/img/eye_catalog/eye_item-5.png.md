WebP Express 0.19.0. Conversion triggered using bulk conversion, 2021-03-24 08:31:06

*WebP Convert 2.3.2*  ignited.
- PHP version: 7.4.14
- Server software: Apache

Stack converter ignited

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: D:\programming\OpenServer\domains\axe/wp-content/themes/axe/axe__/img/eye_catalog/eye_item-5.png
- destination: D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/themes/axe\axe__\img\eye_catalog\eye_item-5.png.webp
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
- source: D:\programming\OpenServer\domains\axe/wp-content/themes/axe/axe__/img/eye_catalog/eye_item-5.png
- destination: D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/themes/axe\axe__\img\eye_catalog\eye_item-5.png.webp
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
D:\programming\OpenServer\domains\axe\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe -metadata none -q 85 -alpha_q "80" -m 6 -low_memory "D:\programming\OpenServer\domains\axe/wp-content/themes/axe/axe__/img/eye_catalog/eye_item-5.png" -o "D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/themes/axe\axe__\img\eye_catalog\eye_item-5.png.webp.lossy.webp" 2>&1 2>&1

*Output:* 
Saving file 'D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/themes/axe\axe__\img\eye_catalog\eye_item-5.png.webp.lossy.webp'
File:      D:\programming\OpenServer\domains\axe/wp-content/themes/axe/axe__/img/eye_catalog/eye_item-5.png
Dimension: 253 x 130 (with alpha)
Output:    9060 bytes Y-U-V-All-PSNR 44.01 46.61 45.80   44.62 dB
           (2.20 bpp)
block count:  intra4:         78  (54.17%)
              intra16:        66  (45.83%)
              skipped:        48  (33.33%)
bytes used:  header:            197  (2.2%)
             mode-partition:    416  (4.6%)
             transparency:     3899 (59.7 dB)
 Residuals bytes  |segment 1|segment 2|segment 3|segment 4|  total
  intra4-coeffs:  |    3614 |       0 |      14 |       6 |    3634  (40.1%)
 intra16-coeffs:  |      40 |       0 |       0 |      16 |      56  (0.6%)
  chroma coeffs:  |     783 |       0 |       2 |      18 |     803  (8.9%)
    macroblocks:  |      74%|       0%|       1%|      26%|     144
      quantizer:  |      17 |      12 |       8 |       8 |
   filter level:  |       5 |       3 |       2 |       2 |
------------------+---------+---------+---------+---------+-----------------
 segments total:  |    4437 |       0 |      16 |      40 |    4493  (49.6%)
Lossless-alpha compressed size: 3898 bytes
  * Header size: 72 bytes, image data size: 3826
  * Lossless features used: PALETTE
  * Precision Bits: histogram=3 transform=3 cache=0
  * Palette size:   96

Success
Reduction: 75% (went from 35 kb to 9 kb)

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
D:\programming\OpenServer\domains\axe\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe -metadata none -q 85 -alpha_q "80" -near_lossless 60 -m 6 -low_memory "D:\programming\OpenServer\domains\axe/wp-content/themes/axe/axe__/img/eye_catalog/eye_item-5.png" -o "D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/themes/axe\axe__\img\eye_catalog\eye_item-5.png.webp.lossless.webp" 2>&1 2>&1

*Output:* 
Saving file 'D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/themes/axe\axe__\img\eye_catalog\eye_item-5.png.webp.lossless.webp'
File:      D:\programming\OpenServer\domains\axe/wp-content/themes/axe/axe__/img/eye_catalog/eye_item-5.png
Dimension: 253 x 130
Output:    16888 bytes (4.11 bpp)
Lossless-ARGB compressed size: 16888 bytes
  * Header size: 1264 bytes, image data size: 15598
  * Lossless features used: PREDICTION CROSS-COLOR-TRANSFORM SUBTRACT-GREEN
  * Precision Bits: histogram=2 transform=2 cache=9

Success
Reduction: 53% (went from 35 kb to 16 kb)

Picking lossy
cwebp succeeded :)

Converted image in 1155 ms, reducing file size with 75% (went from 35 kb to 9 kb)
