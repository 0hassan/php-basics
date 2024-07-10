<?php

function customError($errno, $errstr)
{
  echo "<b>Error:</b> [$errno] $errstr<br>";
  echo "Ending Script";
  die();
}

set_error_handler("customError");

trait Greet
{
  public function sayHello()
  {
    echo "Hello<br>";
  }

  public function sayGoodbye()
  {
    echo "Goodbye<br>";
  }
}

class Car
{
  public $color;
  private $serialNumber;
  protected $price;
  use Greet;

  public function __construct($color, $serialNumber, $price)
  {
    $this->color = $color;
    $this->serialNumber = $serialNumber;
    $this->price = $price;
  }

  public function getSerialNumber()
  {
    return $this->serialNumber;
  }

  public function getPrice()
  {
    return $this->price;
  }

  public function setPrice($price)
  {
    $this->price = $price;
  }

  public function display()
  {
    echo "Color: " . $this->color . "<br>";
    echo "Serial Number: " . $this->serialNumber . "<br>";
    echo "Price: " . $this->price . "<br>";
  }
}

class Truck extends Car
{
  public $loadCapacity;
  use Greet;

  public function __construct($color, $serialNumber, $price, $loadCapacity)
  {
    parent::__construct($color, $serialNumber, $price);
    $this->loadCapacity = $loadCapacity;
  }

  public function display()
  {
    parent::display();
    echo "Load Capacity: " . $this->loadCapacity . "<br>";
  }

  public function setPrice($price)
  {
    $this->price = $price * 1.1;
  }

  public function getLoadCapacity()
  {
    return $this->loadCapacity;
  }

  public function setLoadCapacity($loadCapacity)
  {
    $this->loadCapacity = $loadCapacity;
  }
}

?>

<!-- html page to handle the logics -->
<!DOCTYPE html>
<html>

<head>
  <title>Classes</title>
</head>

<body>
  <?php

  set_error_handler("customError");

  include 'connectionToDB.php';

  $car = new Car("Red", 123, 1000);
  $car->sayHello();
  $car->display();
  echo "<br>";

  $truck = new Truck("Blue", 456, 2000, 500);
  $truck->display();
  echo "<br>";

  $insertData = "INSERT INTO Cars (color, serialNumber, price) VALUES ('Red', 123, 1000)";

  if ($connection->conn->query($insertData) === TRUE) {
    echo "Data inserted successfully";
  } else {
    echo "Error inserting data: " . $connection->conn->error;
  }

  $truck->setPrice(3000);
  $truck->setLoadCapacity(1000);
  $truck->display();
  $truck->sayGoodbye();
  ?>
</body>

</html>