WebP Express 0.19.0. Conversion triggered using bulk conversion, 2021-03-24 08:28:44

*WebP Convert 2.3.2*  ignited.
- PHP version: 7.4.14
- Server software: Apache

Stack converter ignited
Destination folder does not exist. Creating folder: D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/uploads

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: D:\programming\OpenServer\domains\axe/wp-content/uploads/woocommerce-placeholder-1024x1024.png
- destination: D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/uploads/woocommerce-placeholder-1024x1024.png.webp
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
- source: D:\programming\OpenServer\domains\axe/wp-content/uploads/woocommerce-placeholder-1024x1024.png
- destination: D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/uploads/woocommerce-placeholder-1024x1024.png.webp
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
D:\programming\OpenServer\domains\axe\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe -metadata none -q 85 -alpha_q "80" -m 6 -low_memory "D:\programming\OpenServer\domains\axe/wp-content/uploads/woocommerce-placeholder-1024x1024.png" -o "D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/uploads/woocommerce-placeholder-1024x1024.png.webp.lossy.webp" 2>&1 2>&1

*Output:* 
Saving file 'D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/uploads/woocommerce-placeholder-1024x1024.png.webp.lossy.webp'
File:      D:\programming\OpenServer\domains\axe/wp-content/uploads/woocommerce-placeholder-1024x1024.png
Dimension: 1024 x 1024
Output:    6630 bytes Y-U-V-All-PSNR 55.41 62.62 64.89   56.85 dB
           (0.05 bpp)
block count:  intra4:        240  (5.86%)
              intra16:      3856  (94.14%)
              skipped:      3705  (90.45%)
bytes used:  header:             92  (1.4%)
             mode-partition:   2785  (42.0%)
 Residuals bytes  |segment 1|segment 2|segment 3|segment 4|  total
  intra4-coeffs:  |    2914 |       0 |       6 |     111 |    3031  (45.7%)
 intra16-coeffs:  |     189 |       4 |       9 |     301 |     503  (7.6%)
  chroma coeffs:  |     154 |       1 |       3 |      33 |     191  (2.9%)
    macroblocks:  |       8%|       0%|       0%|      92%|    4096
      quantizer:  |      20 |      19 |      16 |      13 |
   filter level:  |       9 |       4 |       3 |       2 |
------------------+---------+---------+---------+---------+-----------------
 segments total:  |    3257 |       5 |      18 |     445 |    3725  (56.2%)

Success
Reduction: 92% (went from 82 kb to 6 kb)

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
D:\programming\OpenServer\domains\axe\wp-content\plugins\webp-express\vendor\rosell-dk\webp-convert\src\Convert\Converters\Binaries\cwebp-110-windows-x64.exe -metadata none -q 85 -alpha_q "80" -near_lossless 60 -m 6 -low_memory "D:\programming\OpenServer\domains\axe/wp-content/uploads/woocommerce-placeholder-1024x1024.png" -o "D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/uploads/woocommerce-placeholder-1024x1024.png.webp.lossless.webp" 2>&1 2>&1

*Output:* 
Saving file 'D:\programming\OpenServer\domains\axe/wp-content/webp-express/webp-images/uploads/woocommerce-placeholder-1024x1024.png.webp.lossless.webp'
File:      D:\programming\OpenServer\domains\axe/wp-content/uploads/woocommerce-placeholder-1024x1024.png
Dimension: 1024 x 1024
Output:    43208 bytes (0.33 bpp)
Lossless-ARGB compressed size: 43208 bytes
  * Header size: 1456 bytes, image data size: 41727
  * Lossless features used: PREDICTION CROSS-COLOR-TRANSFORM SUBTRACT-GREEN
  * Precision Bits: histogram=5 transform=4 cache=10

Success
Reduction: 49% (went from 82 kb to 42 kb)

Picking lossy
cwebp succeeded :)

Converted image in 2615 ms, reducing file size with 92% (went from 82 kb to 6 kb)
