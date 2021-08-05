WebP Express 0.19.0. Conversion triggered using bulk conversion, 2021-03-24 08:29:32

*WebP Convert 2.3.2*  ignited.
- PHP version: 7.4.14
- Server software: Apache

Stack converter ignited
Destination folder does not exist. Creating folder: D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/themes/axe\axe__\img\axe-group

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: D:\programming\OpenServer\domains\axe/wp-content/themes/axe/axe__/img/axe-group/axe-1.png
- destination: D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/themes/axe\axe__\img\axe-group\axe-1.png.webp
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
- source: D:\programming\OpenServer\domains\axe/wp-content/themes/axe/axe__/img/axe-group/axe-1.png
- destination: D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/themes/axe\axe__\img\axe-group\axe-1.png.webp
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
D:\programming\OpenServer\domains\axe\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe -metadata none -q 85 -alpha_q "80" -m 6 -low_memory "D:\programming\OpenServer\domains\axe/wp-content/themes/axe/axe__/img/axe-group/axe-1.png" -o "D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/themes/axe\axe__\img\axe-group\axe-1.png.webp.lossy.webp" 2>&1 2>&1

*Output:* 
Saving file 'D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/themes/axe\axe__\img\axe-group\axe-1.png.webp.lossy.webp'
File:      D:\programming\OpenServer\domains\axe/wp-content/themes/axe/axe__/img/axe-group/axe-1.png
Dimension: 1112 x 182 (with alpha)
Output:    26206 bytes Y-U-V-All-PSNR 44.08 44.77 45.11   44.34 dB
           (1.04 bpp)
block count:  intra4:        448  (53.33%)
              intra16:       392  (46.67%)
              skipped:       278  (33.10%)
bytes used:  header:            292  (1.1%)
             mode-partition:   2430  (9.3%)
             transparency:     4914 (99.0 dB)
 Residuals bytes  |segment 1|segment 2|segment 3|segment 4|  total
  intra4-coeffs:  |   13041 |     107 |     102 |      97 |   13347  (50.9%)
 intra16-coeffs:  |     367 |      10 |      59 |      54 |     490  (1.9%)
  chroma coeffs:  |    4377 |      72 |      83 |     148 |    4680  (17.9%)
    macroblocks:  |      64%|       2%|       2%|      32%|     840
      quantizer:  |      18 |      14 |      11 |       8 |
   filter level:  |      63 |       3 |       2 |       6 |
------------------+---------+---------+---------+---------+-----------------
 segments total:  |   17785 |     189 |     244 |     299 |   18517  (70.7%)
Lossless-alpha compressed size: 4913 bytes
  * Header size: 72 bytes, image data size: 4841
  * Precision Bits: histogram=4 transform=4 cache=0
  * Palette size:   36

Success
Reduction: 87% (went from 204 kb to 26 kb)

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
D:\programming\OpenServer\domains\axe\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe -metadata none -q 85 -alpha_q "80" -near_lossless 60 -m 6 -low_memory "D:\programming\OpenServer\domains\axe/wp-content/themes/axe/axe__/img/axe-group/axe-1.png" -o "D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/themes/axe\axe__\img\axe-group\axe-1.png.webp.lossless.webp" 2>&1 2>&1

*Output:* 
Saving file 'D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/themes/axe\axe__\img\axe-group\axe-1.png.webp.lossless.webp'
File:      D:\programming\OpenServer\domains\axe/wp-content/themes/axe/axe__/img/axe-group/axe-1.png
Dimension: 1112 x 182
Output:    95288 bytes (3.77 bpp)
Lossless-ARGB compressed size: 95288 bytes
  * Header size: 2368 bytes, image data size: 92894
  * Lossless features used: PREDICTION CROSS-COLOR-TRANSFORM SUBTRACT-GREEN
  * Precision Bits: histogram=4 transform=4 cache=10

Success
Reduction: 54% (went from 204 kb to 93 kb)

Picking lossy
cwebp succeeded :)

Converted image in 1485 ms, reducing file size with 87% (went from 204 kb to 26 kb)
