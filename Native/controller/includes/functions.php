<?php

    require_once('connection.php');

    function InsertRecord()
    {
        global $conn;
        $UserName = $_POST['UserName'];
        $UserEmail = $_POST['UserEmail'];
        $UserCompany = $_POST['UserCompany'];

        $companyq = "insert into companies (company_name) values(:UserCompany)";
        $statementcompany = $conn->prepare($companyq);

        $statementcompany->bindValue(':UserCompany', $UserCompany);
        $result = $statementcompany->execute();
        $compId = $conn->lastInsertId();


        $query = "insert into clients (name,email) values(:UserName,:UserEmail)";
        //Prepare our statement.
        $statement = $conn->prepare($query);

        $statement->bindValue(':UserName', $UserName);
        $statement->bindValue(':UserEmail', $UserEmail);

        $result = $statement->execute();
        $clientId = $conn->lastInsertId();


        $query = "insert into companies_clients_r (client_id,company_id) values(:client_id,:company_id)";
        //Prepare our statement.
        $statementlink = $conn->prepare($query);

        $statementlink->bindValue(':client_id', $clientId);
        $statementlink->bindValue(':company_id', $compId);

        $result = $statementlink->execute();



    }

    function display_record()
    {
        global $conn;

        $limit = 5;

        if (isset($_POST['page_no'])) {
            $page_no = $_POST['page_no'];
        }else{
            $page_no = 1;
        }
    
        $offset = ($page_no-1) * $limit;


        $value = "";
        $value = '<table class="table table-bordered align-middle">
                    <thead class="thead-dark">
                    <tr>
                        <th> User ID </td>
                        <th> User User </td>
                        <th> User Email</td>
                        <th> Company </td>
                    </tr>';
        $query = "SELECT c3.id, c3.name, c3.email, c2.company_name FROM clients c3
        INNER JOIN companies_clients_r c1 ON c3.id = c1.client_id
        INNER JOIN companies c2 ON c2.id = c1.company_id
        ORDER BY c3.id DESC LIMIT $offset, $limit";
        $data = $conn->query($query)->fetchAll();
        foreach ($data as $row) {
            $value.= ' <tr>
                        <td> '.$row['id'].' </td>
                        <td> '.$row['name'].' </td>
                        <td> '.$row['email'].'</td>
                        <td> '.$row['company_name'].' </td>
                    </tr>';
        }
        $value.='</table>';

        $sql = "SELECT * FROM clients";
        $totalRecords  = $conn->query($sql)->rowCount();

        $totalPage = ceil($totalRecords/$limit);


        $value.="<ul class='pagination justify-content-center' style='margin:20px 0'>";

        for ($i=1; $i <= $totalPage ; $i++) { 
            if ($i == $page_no) {
             $active = "active";
            }else{
             $active = "";
            }
     
             $value.="<li class='page-item $active'><a class='page-link' id='$i' href=''>$i</a></li>";
         }
     
         $value .= "</ul>";

        echo json_encode(['status'=>'success','html'=>$value]);

    }


    function display_api()
    {
        global $conn;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, 'https://ah-devsec.com/test/');
        $result = curl_exec($ch);
        curl_close($ch);
        
        $obj = json_decode($result);
        $arrays = array();
        foreach($obj as $json_value)
        {
        
        $name= $json_value->name;
        $query = "SELECT c3.id, c3.name, c3.email, c2.company_name FROM clients c3
        INNER JOIN companies_clients_r c1 ON c3.id = c1.client_id
        INNER JOIN companies c2 ON c2.id = c1.company_id
        WHERE c3.name = '$name'
        ORDER BY c3.id";
            $data = $conn->query($query)->fetchAll();
            
          
            foreach($data as $record){
            $new_array = array(
                "name" => $record['name'], 
                "email" => $json_value->email, 
                "company" => $record['company_name']);

                array_push($arrays, $new_array);
            }
           // var_dump($arrays);

        }
         return $arrays;

    }

?>

