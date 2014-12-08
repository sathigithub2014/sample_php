<?php
    require("php_serial.class.php");
// include("php_serial.class.php");

    // Let's start the class
    $serial = new phpSerial();

    // First we must specify the device. This works on both Linux and Windows (if
    // your Linux serial device is /dev/ttyS0 for COM1, etc.)
    $serial->deviceSet("/dev/ttyACM0");

    // Set for 9600-8-N-1 (no flow control)
    $serial->confBaudRate(9600); //Baud rate: 9600
    $serial->confParity("none");  //Parity (this is the "N" in "8-N-1")
    $serial->confCharacterLength(8); //Character length     (this is the "8" in "8-N-1")
    $serial->confStopBits(1);  //Stop bits (this is the "1" in "8-N-1")
    $serial->confFlowControl("none");

    // Then we need to open it
    $serial->deviceOpen();

    // Read data
    $read = $serial->readPort();
print "<pre>";
print_r($read);
print "</pre>";

    // Print out the data
    echo $read;
        // print exec("echo 'r9g9b9' > /dev/ttyACM0");
    print "RESPONSE(1): {$read}<br><br>";

    // If you want to change the configuration, the device must be closed.
    $serial->deviceClose();
?>

<?php
    if( isset($_REQUEST['LED']) )
        response();
?>

<form action='index.php' method='POST'>
    <select id='led' name='LED'>
        <option id='nil'>-</option>
        <option id='red'>RED</option>
        <option id='green'>GREEN</option>
        <option id='blue'>BLUE</option>
        <option id='all'>ALL</option>
    </select>
    <input type='submit' value='SET'>
</form>

<?php
    print "Hi, Earthlings!";

    function response(){
        $CMDString = "";
        $execute   = false;

        if( isset($_REQUEST['LED']) ){
                switch ($_REQUEST['LED']) {
                    case 'RED':
                        $CMDString = 'r9';
                        $execute = true;

        exec("echo 'r9g0b0' > /dev/ttyACM0");

                print "<br>FOUND: {$_REQUEST['LED']}";
                        break;
                    case 'GREEN':
                        $CMDString = 'g9';
                        $execute = true;
                print "<br>FOUND: {$_REQUEST['LED']}";
                        break;
                    case 'BLUE':
                        $CMDString = 'b9';
                        $execute = true;
                print "<br>FOUND: {$_REQUEST['LED']}";
                        break;
                    case 'ALL':
                        $CMDString = 'r9g9b9';
                        $execute = true;
                print "<br>FOUND: {$_REQUEST['LED']}";
                        break;
                    default:
                        print exec("echo 'r0g0b0' > /dev/ttyACM0");
                        $execute = false;
                        break;
                }

                if($execute){
                    print exec("echo '{$CMDString}' > /dev/ttyACM0");
                    print "<br><br>executing: {$CMDString}";
                }
        }
    }
?>