# Samsung Smart TV Control
This class allows a server side script con cotrol a locally accessible TV set to be controlled from it.

## Usage
Copy `SamsungControl.inc.php` to the library directory of your choice on your server and include it in your script. Then, instantiate the SamsungControl-Class and you'll be ready to go. You will need to provide the following data to the script for it to connect successfully to your TV (quoted form):

* **IP\_OF\_YOUR\_TV**
* **IP\_OF\_YOUR_SERVER** ( the one this script is running on )
* **MAC\_OF\_YOUR\_SERVER**
* **MODEL\_OF\_YOUR\_TV** ( such as UE50F6500 )

The keys that can be sent to the TV are:


|Key code|Description|
|--------|----------:|
|KEY_POWEROFF       |Power off
|KEY_UP             |Up
|KEY_DOWN           |Down
|KEY_LEFT           |Left
|KEY_RIGHT          |Right
|KEY_CHUP           |P Up
|KEY_CHDOWN         |P Down
|KEY_ENTER          |Enter
|KEY_RETURN         |Return
|KEY_CH_LIST        |Channel List
|KEY_MENU           |Menu
|KEY_SOURCE         |Source
|KEY_GUIDE          |Guide
|KEY_TOOLS          |Tools
|KEY_INFO           |Info
|KEY_RED            |A / Red
|KEY_GREEN          |B / Green
|KEY_YELLOW         |C / Yellow
|KEY_BLUE           |D / Blue
|KEY_PANNEL_CHDOWN  |3D
|KEY_VOLUP          |Volume Up
|KEY_VOLDOWN        |Volume Down
|KEY_MUTE           |Mute
|KEY_0              |0
|KEY_1              |1
|KEY_2              |2
|KEY_3              |3
|KEY_4              |4
|KEY_5              |5
|KEY_6              |6
|KEY_7              |7
|KEY_8              |8
|KEY_9              |9
|KEY_DTV            |TV Source
|KEY_HDMI           |HDMI Source
|KEY_CONTENTS       |SmartHub


- The first time you execute the script, your TV is going to prompt the user to accept the connection, and once the user allows it to access the TV functions it is going to work without further allowances.

- To revoke a permission, you need to go to **MENU**>**NETWORK**>**ALLSHARE CONFIGURATION**>**CONTENTS EXCHANGE** and delete the allowed remote.

### Sample script
```PHP
<?php

	include_once('SamsungControl.inc.php);

	$TV = new SamsungControl( IP_OF_YOUR_TV, IP_OF_YOUR_SERVER, MAC_OF_YOUR_SERVER, MODEL_OF_YOUR_TV);
	$TV->send(KEY);

?>
```

**&copy;** D.Sanchez _2020_
