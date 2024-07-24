<?php
require_once('./partials/connection.php');
$id = htmlspecialchars($_GET['id']);

$sql = "SELECT * FROM `players` WHERE `id` = $id LIMIT 1";
$result = $connection->query($sql);
$player = $result->fetch_assoc();
// echo "<pre>";
// print_r($player);
// echo "</pre>";

$name = $player['name'];
$strong_foot = $player['strong_foot'];
$position = $player['position'];
$errors = [];
if (isset($_POST['submit'])) {

    $name = htmlspecialchars($_POST['name']);
    $strong_foot = htmlspecialchars($_POST['strong_foot']);
    $position = htmlspecialchars($_POST['position']);

    if (empty($name)) {
        $errors['name'] = 'Provide player name!';
    }

    if (empty($strong_foot)) {
        $errors['strong_foot'] = 'Provide player strong foot!';
    }

    if (empty($position)) {
        $errors['position'] = 'Provide player position!';
    }

    if (count($errors) === 0) {
        $sql = "UPDATE `players` SET `name` = '$name', `strong_foot` = '$strong_foot', `position` = '$position' WHERE `id` = $id";

        if ($connection->query($sql)) {
            $success = "Magic has been spelled!";
        } else {
            $failure = "Magic has failed to spell!";
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Player</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h2 class="m-0">Edit Player</h2>
                            </div>
                            <div class="col-6 text-end">
                                <a href="./" class="btn btn-outline-primary">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <?php
                        if (isset($success)) { ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $success ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        if (isset($failure)) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $failure ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>

                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>?id=<?php echo $id ?>" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" placeholder="Player name!" class="form-control <?php if (isset($errors['name'])) echo 'is-invalid' ?>" value="<?php echo $name ?>">
                                <?php
                                if (isset($errors['name'])) { ?>
                                    <div class="text-danger">
                                        <?php echo $errors['name'] ?>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>

                            <div class="mb-3">
                                <label for="strong_foot" class="form-label">Strong Foot</label>
                                <input type="text" id="strong_foot" name="strong_foot" placeholder="Player strong foot!" class="form-control form-control <?php if (isset($errors['strong_foot'])) echo 'is-invalid' ?>" value="<?php echo $strong_foot ?>">
                                <?php
                                if (isset($errors['strong_foot'])) { ?>
                                    <div class="text-danger">
                                        <?php echo $errors['strong_foot'] ?>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>

                            <div class="mb-3">
                                <label for="position" class="form-label">Position</label>
                                <input type="text" id="position" name="position" placeholder="Player position!" class="form-control <?php if (isset($errors['position'])) echo 'is-invalid' ?> " value="<?php echo $position ?>">
                                <?php
                                if (isset($errors['position'])) { ?>
                                    <div class="text-danger">
                                        <?php echo $errors['position'] ?>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>

                            <div>
                                <input type="submit" name="submit" value="Update" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>