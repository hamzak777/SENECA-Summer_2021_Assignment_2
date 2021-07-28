<?php

require '../utilities/Connector.php';
require '../models/villain.php';

class villainController {
    // create() method will need a parameter to take in the user input.
    // parameter will be a placeholder for the $_POST array.
    public function create($post) {
        // We will check to see if our required fields have been filled out.
        if (!empty($post['name']) && !empty($post['alias']) && !empty($post['introduction']) && !empty($post['image'])) {
            // create a new instance of villain class and its constructor method will tkae the $_POST placeholder.
            $villain = new villain($post);
            // serialize the villain object to store it in one column.
            $villain = serialize($villain);
            // When storing serialized objects in a database it is best practice to use the base64_encode() function to encode the serialized string so that the data does not get corrupted while it is being transferred and for added security.
            $villain = base64_encode($villain);
            // use Connector class' instance getter to get the instance.
            // use get_pdo() getter to get the PDO object and store it in a variable.
            // use an INSERT INTO statement and PDO's prepare() method to prepare our SQL query to insert the villain into the column.
            $db = Connector::get_instance();
            $pdo = $db->get_pdo();
            $sql = "INSERT INTO `villains` (`object`) VALUES ('${villain}')";
            $query = $pdo->prepare($sql);

            // use PDO's execute method to execute the query inside of an if statement to check 
            // if query runs successfully.
            // If so, redirect to the "view" page with a success message
            // else go back to the "add" page with an error message.
            if ($query->execute()) {
                header('Location: ../views/view-villains.php?add=success');
                exit();
            } else {
                header('Location: ../views/add-villain.php?db=error');
                exit();
            }
        } else {
            header('Location: ../views/add-villain.php?add=error');
            exit();
        }
    }

    // The read() method will be used to retreive data from the database.
    // We then need to use our Connector class' instance getter to get the instance.
    // We will then use our get_pdo() getter to get the PDO object and store it in a variable.
    // We can then use a SELECT * FROM statement and PDO's prepare() method to prepare our SQL query to select all rows from the database.
    // Then we need to use PDO's execute() method to run the query.
    // To store the database rows as an array, we ned to use PDO's fetchAll() method and save it as a variable.
    public function read() {
        $db = Connector::get_instance();
        $pdo = $db->get_pdo();
        $sql = "SELECT * FROM `villains`";
        $query = $pdo->prepare($sql);
        $query->execute();
        $villains = $query->fetchAll();

        // used the base64_encode() function to encode our serialized object use the base64_decode() 
        // function to decode it.
        // used serialize() function to convert our object data to a string, use unserialize() 
        // function to convert the data back to its initial format.
        // loop through the villains, decode and unserialize each one and then redefine them.
        // return the villains as an array.
        foreach ($villains as $villain_num => $villain_row) {
            $an_villain = base64_decode($villain_row['object']);
            $an_villain = unserialize($an_villain);
            $villains[$villain_num]['object'] = $an_villain;
        }
        return $villains;
    }

    // The update() method similar to the create method.
    // We need to collect the ID of the villain row from the $_POST array to identify which villain we are updating.
    public function update($post) {
        $id = $post['id'];
        // Even though we are editing existing data, we still need to check to see if our required fields have been filled out.
        if (!empty($post['name']) && !empty($post['alias']) && !empty($post['introduction']) && !empty($post['image'])) {
            // We will create a new instance of our villain class and its constructor method will tkae the $_POST placeholder.
            $villain = new villain($post);
            // Then we will serialize the villain object so that we can store it in one column.
            $villain = serialize($villain);
            // When storing serialized objects in a database it is best practice to use the base64_encode() function to encode the serialized string so that the data does not get corrupted while it is being transferred and for added security.
            $villain = base64_encode($villain);
            // We then need to use our Connector class' instance getter to get the instance.
            // We will then use our get_pdo() getter to get the PDO object and store it in a variable.
            // We can then use an UPDATE statement and PDO's prepare() method to write an SQL query to update `villains` and set `object` to $villain where the `id` matches $id.
            $db = Connector::get_instance();
            $pdo = $db->get_pdo();
            $sql = "UPDATE `villains` SET object='${villain}' WHERE id=${id}";
            $query = $pdo->prepare($sql);

            // We will use PDO's execute method to execute the query inside of an if statement to check to see if the query runs successfully.
            // If so, redirect to the "view" page with a success message, else go back to the "edit" page with an error message.
            if ($query->execute()) {
                header('Location: ../views/view-villains.php?edit=success');
                exit();
            } else {
                header('Location: ../views/edit-villain.php?db=error&id=' . $id);
                exit();
            }
        } else {
            header('Location: ../views/edit-villain.php?edit=error&id=' . $id);
            exit();
        }
    }

    // The delete() method will be very similar to update method.
    // We still need to collect the ID of the villain row from the $_POST array to identify which villain we are deleting. However, we don't need to check if the user has filled out any fields or create a new instance of the villain class as we are simply deleting data.
    public function delete($post) {
        $id = $post['id'];
        // use Connector class' instance getter to get the instance.
        // use get_pdo() getter to get the PDO object and store it in a variable.
        // use a DELETE FROM statement and PDO's prepare() method to 
        // write an SQL query to delete from `villains` where the `id` matches $id.
        $db = Connector::get_instance();
        $pdo = $db->get_pdo();
        $sql = "DELETE FROM `villains` WHERE id=${id}";
        $query = $pdo->prepare($sql);

        // We will use PDO's execute method to execute the query inside of an if statement to check to see if the query runs successfully.
        // If so, redirect to the "view" page with a success message, else go back to the "view" page with an error message.
        if ($query->execute()) {
            header('Location: ../views/view-villains.php?delete=success');
            exit();
        } else {
            header('Location: ../views/view-villains.php?delete=error&id=' . $id);
            exit();
        }
    }
}