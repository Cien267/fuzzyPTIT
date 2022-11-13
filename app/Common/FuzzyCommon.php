<?php

namespace App\Common;

class FuzzyCommon {
  public const  POPULATION_VARIABLES = [
    "SP", //small
    "MP", //medium
    "LP", //large
  ];
  public const GDP_VARIABLES = [
      "VL", //very low
      "LO", //low
      "ME", //medium
      "HI", //high
      "VH" //very high
  ];
  public const GDP_PER_CAPITA_VARIABLES = [
      "LPC", //low
      "MPC", //medium
      "HPC" //high
  ];
  public const UNEMPLOYMENT_RATE_VARIABLES = [
      "LUR", //low
      "MUR", //medium
      "HUR" //high
  ];

  
 public const LOW_ECONOMY = [
  [
      ["SP"], ["VL", "LO", "ME"], ["LPC"], self::UNEMPLOYMENT_RATE_VARIABLES
  ],
  [
      ["SP"], ["VL", "LO", "ME"], ["MPC"], ["HUR"]
  ],
  [
      ["SP"], ["VL", "LO"], self::GDP_PER_CAPITA_VARIABLES, self::UNEMPLOYMENT_RATE_VARIABLES 
  ],
  [
      ["MP"], ["VL"], self::GDP_PER_CAPITA_VARIABLES, self::UNEMPLOYMENT_RATE_VARIABLES
  ],
  [
      ["MP"], ["LO", "ME", "HI"], ["LPC"], self::UNEMPLOYMENT_RATE_VARIABLES
  ],
  [
      ["MP"], ["LO", "ME", "HI"], ["MPC"], ["HUR"]
  ],
  [
      ["MP"], ["VL", "LO"], self::GDP_PER_CAPITA_VARIABLES, self::UNEMPLOYMENT_RATE_VARIABLES 
  ],
  [
      ["LP"], ["ME", "HI", "VH"], ["LPC"], self::UNEMPLOYMENT_RATE_VARIABLES
  ],
  [
      ["LP"], ["ME", "HI", "VH"], ["MPC"], ["HUR"]
  ]
];
public const MEDIUM_ECONOMY = [
  [
          ["SP"], ["VL", "LO", "ME"], ["MPC"], ["LUR", "MUR"]
  ],
  [
          ["SP"], ["VL", "LO", "ME"], ["HPC"], ["HUR"]
  ],
  [
          ["SP", "MP"], ["ME"], self::GDP_PER_CAPITA_VARIABLES, self::UNEMPLOYMENT_RATE_VARIABLES 
  ],
  [
          ["MP"], ["LO", "ME", "HI"], ["MPC"], ["LUR"]
  ],
  [
          ["MP"], ["LO", "ME", "HI"], ["MPC"], ["MUR"]
  ],
  [
          ["MP"], ["LO", "ME", "HI"], ["HPC"], ["HUR"]
  ],
  [
          ["MP"], ["ME"], self::GDP_PER_CAPITA_VARIABLES, self::UNEMPLOYMENT_RATE_VARIABLES 
  ],
  [
          ["LP"], ["VL", "LO"], self::GDP_PER_CAPITA_VARIABLES, self::UNEMPLOYMENT_RATE_VARIABLES 
  ],
  [
          ["LP"], ["ME", "HI", "VH"], ["MPC"], ["LUR"]
  ],
  [
          ["LP"], ["ME", "HI", "VH"], ["MPC"], ["MUR"]
  ],
  [
          ["LP"], ["ME", "HI", "VH"], ["HPC"], ["HUR"]
  ]
];
public const HIGH_ECONOMY = [
  [
          ["SP"], ["VL", "LO", "ME"], ["HPC"], ["LUR", "MUR"]
  ],
  [
          ["SP"], ["HI", "VH"], self::GDP_PER_CAPITA_VARIABLES, self::UNEMPLOYMENT_RATE_VARIABLES 
  ],
  [
          ["MP"], ["HI", "VH"], self::GDP_PER_CAPITA_VARIABLES, self::UNEMPLOYMENT_RATE_VARIABLES 
  ],
  [
          ["MP"], ["LO", "ME", "HI"], ["HPC"], ["LUR"]
  ],
  [
          ["MP"], ["LO", "ME", "HI"], ["HPC"], ["MUR"]
  ],
  [
          ["MP"], ["VH"], self::GDP_PER_CAPITA_VARIABLES, self::UNEMPLOYMENT_RATE_VARIABLES 
  ],
  [
          ["LP"], ["HI"], self::GDP_PER_CAPITA_VARIABLES, self::UNEMPLOYMENT_RATE_VARIABLES  
  ],
  [
          ["LP"], ["ME", "HI", "VH"], ["HPC"], ["LUR"]
  ],
  [
          ["LP"], ["ME", "HI", "VH"], ["HPC"], ["MUR"]
  ],
];
}