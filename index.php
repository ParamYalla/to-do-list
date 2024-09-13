<?php

    $db = mysqli_connect('localhost', 'root', '', 'todo');

    if(isset($_POST['submit'])){
        $task = $_POST['task'];

        if (empty($task)) {
            $errors = "You must enter some task in the input";
        }
        else {
            mysqli_query($db, "INSERT INTO tasks (task) VALUES('$task')");
            header('localhost: index.php');
        }


    }

    if(isset($_GET['del_task'])){
        $id = $_GET['del_task'];
        mysqli_query($db, " DELETE FROM tasks WHERE id =$id");
        header('location:index.php');
    }

    $tasks = mysqli_query($db, "SELECT * FROM tasks");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Todo list</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="heading">
        <h2> 𝑻𝒐-𝑫𝒐 𝒍𝒊𝒔𝒕 𝑾𝒆𝒃 𝑨𝒑𝒑✍</h2>
    </div>

    <form action="index.php" method="POST">
        <?php if (isset($errors)){   ?>
        <p>
            <?php echo $errors; ?>
        </p>
        <?php } ?>
        <input type="text" name="task" class="task_input" placeholder="Enter Task here">
        &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
        <Button type="submit" class="add_btn" name="submit">𝗔𝗱𝗱 𝗧𝗮𝘀𝗸
        </Button>
    </form>

    <table>
        <thead>
            <tr>
                <th>𝗡𝗼.</th>
                <th>𝗧𝗮𝘀𝗸</th>
                <th>𝗗𝗲𝗹𝗲𝘁𝗲</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>

            <tr>

                <td>
                    <?php echo $i; ?>
                </td>

                <td class="task">
                    <?php echo $row['task']; ?>
                </td>

                <td class="delete">
                    <a href="index.php?del_task=<?php echo $row['id']; ?>"><img src="1.png" alt=""></a>
                </td>

            </tr>

            <?php $i++; } ?>

        </tbody>
    </table>
</body>
<script>
      document.addEventListener("contextmenu", (event) => {
         event.preventDefault();
      });


      </script>

      </html>