window.board = {
    id: 'neo',
    name: 'UDOO Neo',
    minPin: 16,
    maxPin: 48 // 48 for i2c2
};

window.board.features = {
    "pwm2": {
        description: 'PWM 2',
        cssClass: 'success',
        configurations: [
            {pins: [35]}
        ]
    },
    "pwm5": {
        description: 'PWM 5',
        cssClass: 'success',
        configurations: [
            {pins: [30]}
        ]
    },
    
    "uart1": {
        description: 'UART 1 (A9-core debug)',
        help: 'Use this component to gain serial debug access to the A9 core: you can access u-boot, read Linux boot log and login into a console.',
        cssClass: 'warning',
        configurations: [
            {pins: [46, 47]}
        ]
    },
    "uart2": {
        description: 'UART 2 (M4-core debug)',
        cssClass: 'warning',
        configurations: [
            {pins: [44, 45]}
        ]
    },
    "uart6": {
        description: 'UART 6 at /dev/ttymxc5',
        cssClass: 'warning',
        configurations: [
            {pins: [30, 31, 32, 33]}
        ]
    },
    
    "flexcan1": {
        description: 'CANBUS 1',
        cssClass: 'info',
        configurations: [
            {pins: [40, 41]}
        ]
    },
    "flexcan2": {
        description: 'CANBUS 2',
        cssClass: 'info',
        configurations: [
            {pins: [42, 43]}
        ]
    },
    
    /*
    "i2c1": {
        description: 'I2C bus 1',
        help: 'This bus is required to use the touch on the UDOO LVDS 7" screen.',
        cssClass: 'success',
        configurations: [
            {pins: [26, 27]}
        ]
    },
    */
    "i2c2": {
        description: 'I2C bus 2 (bricks)',
        help: 'Drag this component on the snap-in connector to use the bricks sensors from Linux. Otherwise the I2C2 bus is assigned to the M4 core (Arduino).',
        cssClass: 'success',
        configurations: [
            {pins: [48]}
        ]
    },
    "i2c4": {
        description: 'I2C bus 4 (9-axis)',
        cssClass: 'success',
        help: 'Drag this component on pins 34-35 to use the 9-axis sensors from Linux. Otherwise the I2C4 bus is assigned to the M4 core (Arduino).',
        configurations: [
            {pins: [34, 35]}
        ]
    },
    
    "sound_dac": {
        description: 'I2S audio',
        cssClass: 'info',
        depends: [
            'codec_dac',
            'ssi1'
        ],
        configurations: [
            {pins: [25, 26, 27]}
        ]
    },
    "sound_spdif": {
        description: 'SPDIF audio',
        cssClass: 'info',
        depends: [
            'spdif',
        ],
        configurations: [
            {pins: [30]}
        ]
    },
    
    "1wire": {
        description: '1-Wire (on any pin)',
        cssClass: 'warning',
        configurations: [
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
            {pins: [47]}
        ]
    }
};
