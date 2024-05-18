<!DOCTYPE html>
<html lang="en">

<head>
    <title>Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <div>
            <input type="number" name="nr1" placeholder="Number one" step="0.01" required>
        </div>
           
        <div>
            <p></p>
            <input type="number" name="nr2" placeholder="Number two" step="0.01" required>
            <p></p>
        </div>    

        <div>
            <input type="submit" value="add" name="operator" alt="add">
            <input type="submit" value="sub" name="operator">
            <input type="submit" value="mult" name="operator">
            <input type="submit" value="div" name="operator">
        </div>

    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nr1 = filter_input(INPUT_POST,"nr1", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $nr2 = filter_input(INPUT_POST,"nr2", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $operator = htmlspecialchars($_POST["operator"]);
            $errors = false;
            if(empty($operator)) {
                echo "<p class='calc-error'>Select operator!</p>";
            } else {
                $val = 0;
                $op = "";
                switch ($operator) {
                    case "add":
                        $op = "+";
                        $val = $nr1 + $nr2;
                        break;
                    case "sub":
                        $op = "-";
                        $val = $nr1 - $nr2;
                        break;
                    case "mult":
                        $op = "*";
                        $val = $nr1 * $nr2;
                        break;
                    case "div":
                        if($nr2 == 0) {
                            echo "<p class='calc-error'>Cannot devide with zero!</p>";
                            return;
                        }
                        $op = "/";
                        $val = $nr1 / $nr2;
                        break;
                    default:
                        echo "<p class='calc-error'>Invalid operation</p>";
                        return;
                }
                echo "<p class='result'>" . $nr1 . " " . $op . " " . $nr2 . " = " . $val . "</p>";
            }
        }

        

        
    ?>

</body>

</html>