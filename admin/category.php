<!DOCTYPE html>
<html>
    <head>
        <title>Manage Category</title>
        <link rel="stylesheet" href="../css/fontawesome.css">
        <link rel="stylesheet" href="../css/solid.css">
        <style>
            body {
                margin: 20px;
                background-image: linear-gradient(to right, #74F2CE,#82c28d);
            }
            table {
                text-align: center;
                border:2px solid white;
                border-radius: 10px;
                padding:15px;
            }
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
            i {
                cursor: pointer;
            }

            div {
                text-align: center;
                padding:80px 50px 80px 50px;
                width:1000px;
                height: 400px;
                margin:0 auto 0 auto;
            }

            h1{
                font-family:Arial, Helvetica, sans-serif;
                font-size: 35px;
    }

    button{
        display:inline-block;
        padding:0.55em 1.4em;
        border:0.1em solid #FFFFFF;
        margin:0 0.3em 0.3em 0;
        border-radius:0.12em;
        box-sizing: border-box;
        text-decoration:none;
        font-family:'Roboto',sans-serif;
        font-weight:300;
        color:#240c3f;
        text-align:center;
        transition: all 0.3s;
        cursor: pointer;       
    }

    button:hover{
        color:#fff9f9;
        background-color:#251212;
        
    }

    @media all and (max-width:30em){
        button{
        display:block;
        margin:0.4em auto;
}
    }
            
        </style>
    </head>
    <body>
        <div>
        <h1><u>Manage Category</u></h1>
        <table width="1000px";>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Game</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <tr id="1">
                <td>1</td>
                <td>Open World</td>
                <td>Horizon Zero Dawn</td>
                <td><i class="fa-solid fa-pen-to-square"></i></td>
                <td><i class="fa-solid fa-trash-can" onclick="deleteInfo('1')"></i></td>
            </tr>
            <tr id="2">
                <td>2</td>
                <td>Survival</td>
                <td>Minecraft</td>
                <td><i class="fa-solid fa-pen-to-square"></i></td>
                <td><i class="fa-solid fa-trash-can" onclick="deleteInfo('2')"></i></td>
            </tr>
            <tr id="3">
                <td>3</td>
                <td>Role-Playing</td>
                <td>Honkai Impact 3rd</td>
                <td><i class="fa-solid fa-pen-to-square"></i></td>
                <td><i class="fa-solid fa-trash-can" onclick="deleteInfo('3')"></i></td>
            </tr>
            <tr id="4">
                <td>4</td>
                <td>Horror</td>
                <td>Five Nights at Freddy's</td>
                <td><i class="fa-solid fa-pen-to-square"></i></td>
                <td><i class="fa-solid fa-trash-can" onclick="deleteInfo('4')"></i></td>
            </tr>
            <tr id="5">
                <td>5</td>
                <td>Fighting</td>
                <td>Demon Slayer -Kimetsu no Yaiba- The Hinokami Chronicles</td>
                <td><i class="fa-solid fa-pen-to-square"></i></td>
                <td><i class="fa-solid fa-trash-can" onclick="deleteInfo('5')"></i></td>
            </tr>
            <tr hidden id="extra">
                <form action="">
                    <td><input type="number" value="6" style="width: 10px;" name="id"></td>
                    <td><input type="text" name="name"></td>
                    <td><select id="game">
                        <option value="1">Horizon Zero Dawn</option>
                        <option value="2">Minecraft</option>
                        <option value="3">Honkai Impact 3rd</option>
                        <option value="4">Five Nights at Freddy's</option>
                        <option value="5">Demon Slayer -Kimetsu no Yaiba- The Hinokami Chronicles</option>
                    </select></td>
                    <td colspan="2"><input type="submit" value="Submit"></td>
                </form>
            </tr>
            <tr>
                <td><i class="fa-solid fa-circle-plus" onclick="add()"></i></td>
            </tr>
        </table>
    
        <button onclick="history.back()" style="margin: 15px 0;">Back</button>
    </div>
        <script>
            function add() {
                document.getElementById("extra").hidden = false;
            }
            function deleteInfo(id) {
                if (window.confirm("Are you sure you want to delete the information?")) {
                    window.alert("Information has been deleted.");
                    document.getElementById(id).hidden = true;
                }
            }
        </script>
    </body>