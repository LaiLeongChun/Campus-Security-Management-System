<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Make a Review</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="refresh" content="delay_time; URL=new_website_url" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap');

        .review_row2 {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
        }


        .review_row2>input {
            display: none;
        }

        .review_row2>label {
            position: relative;
            width: 1.1em;
            font-size: 8vw;
            margin-top: -40px;
            color: #FFD700;
            cursor: pointer;
        }

        .review_row2>label::before {
            content: "\2605";
            position: absolute;
            opacity: 0;
        }

        .review_row2>label:hover:before,
        .review_row2>label:hover~label:before {
            opacity: 1 !important;
        }

        .review_row2>input:checked~label:before {
            opacity: 1;
        }

        .review_row2:hover>input:checked~label:before {
            opacity: 0.4;
        }

        body {
            background-size: 100%;
            background-color: darkorchid;
        }

        .review_form {
            background: linear-gradient(to right, #00093c, #1b2838f1);
            border: 3px double white;
            border-radius: 10px;
            box-sizing: border-box;
            padding: 20px;
        }

        .review_row3_4 {
            display: flex;
        }

        .review_row4 {
            flex: 50%;
            text-align: right;
        }

        input[type=submit],
        input[type=button] {
            display: inline-block;
            padding: 0.35em 1.2em;
            border: 0.1em solid #FFFFFF;
            margin: 0 0.3em 0.3em 0;
            border-radius: 0.12em;
            box-sizing: border-box;
            text-decoration: none;
            font-family: 'Roboto', sans-serif;
            font-weight: 300;
            color: #240c3f;
            text-align: center;
            transition: all 0.2s;
            cursor: pointer;
        }

        input[type=submit]:hover,
        input[type=button]:hover {
            color: #fff9f9;
            background-color: #251212;

        }

        textarea {
            border-radius: 10px;
            padding: 5px;
        }

        .review_form {
            width: 700px;
            margin: auto;
            margin-top: 120px;
        }

        @media all and (max-width:30em) {

            input[type=submit],
            input[type=button] {
                display: block;
                margin: 0.4em auto;
            }
        }
    </style>
</head>

<body>
    <div class="review_form">

        <form action='' method='POST'>

            <div class="review_row1">
                <h1><label for="reviewnow"
                        style="color:whitesmoke;font-family: 'Bree Serif', serif;margin-left:10px;">Leave a
                        Feedback</label></h1>
            </div>

            <textarea id="reviewnow" name="review" rows="6" cols="85" maxlength="450"
                placeholder="Place your comment here..."></textarea>

            <br>

            <div class="review_row3_4">

                <div class="review_row3">
                    <input type="submit" value="Submit">
                </div>

                <div class="review_row4">
                    <input type="button" value="Back" onclick="window.location.href='store.php'" />
                </div>

            </div>

        </form>
    </div>

</body>

</html>

<?php
include ('connection.php');
if (!empty($_POST)) {

    $rating = $_POST['rating'];
    $review = $_POST['review'];

    # -- data validation --
    if (empty($rating) or empty($review)) {
        die("<script>alert('Please rate before submitting!');
        window.history.back();</script>");
    }

    # pre-excecuting
    $rate_query = "insert into rating
    (customer_id, product_id, review, rate_level)
    values
    ('" . $_SESSION['customer_id'] . "','" . $_SESSION['product_id'] . "', '$review', '$rating')";

    # excecuting
    if (mysqli_query($condb, $rate_query)) {
        echo "<script>alert('Thank You For Reviewing!');
        window.location.href='store.php';</script>";
    } else {
        echo "<script>alert('Please Try Again.');
        window.history.back();</script>";
    }
}
?>