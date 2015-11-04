window.board = {
    name: 'UDOO Quad/Dual',
    maxPin: 55
};

window.board.features = {
    "pwm1": {
        description: 'PWM 1',
        cssClass: 'success',
        configurations: [
            {pins: [8]}
        ]
    },
    "pwm2": {
        description: 'PWM 2',
        cssClass: 'success',
        configurations: [
            {pins: [9]}
        ]
    },
    "pwm3": {
        description: 'PWM 3',
        cssClass: 'success',
        configurations: [
            {pins: [4]}
        ]
    },
    "pwm4": {
        description: 'PWM 4',
        cssClass: 'success',
        configurations: [
            {pins: [5]}
        ]
    },
    
    "usdhc1": {
        description: 'SD card 1',
        cssClass: 'info',
        configurations: [
            {pins: [2, 3, 4, 5, 8, 9]}
        ]
    },
    
    "uart3": {
        description: 'UART 3 at /dev/ttymxc2',
        cssClass: 'warning',
        configurations: [
            {pins: [47, 53]}
        ]
    },
    "uart5": {
        description: 'UART 5 at /dev/ttymxc4',
        cssClass: 'warning',
        configurations: [
            {pins: [16, 17]}
        ]
    },
    
    "i2c1": {
        description: 'I2C bus 1',
        cssClass: 'danger',
        configurations: [
            {pins: [20, 21]}
        ]
    },
    
    "1wire": {
        description: '1-Wire (on any pin)',
        cssClass: 'danger',
        configurations: [
            {pins: [2]},
            {pins: [3]},
            {pins: [4]},
            {pins: [5]},
            {pins: [6]},
            {pins: [7]},
            {pins: [8]},
            {pins: [9]},
            {pins: [10]},
            {pins: [11]},
            {pins: [12]},
            {pins: [13]},
            {pins: [14]},
            {pins: [15]},
            {pins: [16]},
            {pins: [17]},
            {pins: [18]},
            {pins: [19]},
            {pins: [20]},
            {pins: [21]},
            {pins: [22]},
            {pins: [23]},
            {pins: [24]},
            {pins: [25]},
            {pins: [26]},
            {pins: [27]},
            {pins: [28]},
            {pins: [29]},
            {pins: [30]},
            {pins: [31]},
            {pins: [32]},
            {pins: [33]},
            {pins: [34]},
            {pins: [35]},
            {pins: [36]},
            {pins: [37]},
            {pins: [38]},
            {pins: [39]},
            {pins: [40]},
            {pins: [41]},
            {pins: [42]},
            {pins: [43]},
            {pins: [44]},
            {pins: [45]},
            {pins: [46]},
            {pins: [47]},
            {pins: [48]},
            {pins: [49]},
            {pins: [50]},
            {pins: [51]},
            {pins: [52]},
            {pins: [53]}
        ]
    }
    
/*
    "SPDIF": [
      {pins: [21, 44]}
    ],
    "SPI1": [
      {pins: [36, 37, 45, 46, 53]}
    ],
    "SPI2": [
      {pins: [31, 50, 51, 52, 53]}
    ],
    "SPI5": [
      {pins: [4, 5, 8, 9]}
    ],
    "DIGITALAUDIO": [
      {pins: [29, 30, 32, 33, 34, 35]}
    ],
    "CAN": [
      {pins: [54, 55]}
    ],
*/
};
