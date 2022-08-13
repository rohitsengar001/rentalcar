<?php
if (!defined('BLOCK_DIRECT_ACCESS')) {
    die("page not found");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        BOOKING VEHICLES
    </title>
    <!-- Bootstrap 4 CSS -->
    <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <!-- Mobiscroll JS and CSS Includes -->
    <link rel="stylesheet" href="../../resources/datepicker/css/mobiscroll.javascript.min.css"/>
    <script src="../../resources/datepicker/js/mobiscroll.javascript.min.js"></script>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
        }

        button {
            display: inline-block;
            margin: 5px 5px 0 0;
            padding: 10px 30px;
            outline: 0;
            border: 0;
            cursor: pointer;
            background: #5185a8;
            color: #fff;
            text-decoration: none;
            font-family: arial, verdana, sans-serif;
            font-size: 14px;
            font-weight: 100;
        }

        input {
            width: 100%;
            margin: 0 0 5px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 0;
            font-family: arial, verdana, sans-serif;
            font-size: 14px;
            box-sizing: border-box;
            -webkit-appearance: none;
        }

        .mbsc-page {
            padding: 1em;
        }
    </style>
</head>

<body>
<?php include './navbar.php';
function load($data): void
{
?>
<!--CONTAINER START-->
<div class="container">
    <section class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="../../upload/<?= $data['filename'] ?>" alt="..." style="width: 280px" class="rounded">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">Model Number <span
                                    class="p-3 font-weight-bold"><?= strtoupper($data['vehicle_model']) ?></span></li>
                        <li class="list-group-item">Vehicle Number : <span
                                    class="p-3 font-weight-bold"><?= strtoupper($data['vehicle_number']) ?></span></li>
                        <li class="list-group-item">Rent Per Day :<span
                                    class="p-3 font-weight-bold"><?= strtoupper($data["rent_per_day"]) ?></span></li>
                    </ul>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
        </div>
    </section>

    <!-- BOOKING SECTION-->
    <section>
        <hr style="border-style:dashed">
        <div class="card-body bg-dark font-weight-bold text-light">
            <h3 class="text-center ">Booking Details</h3>
            <form action="" method="post" class="rounded-lg shadow-lg">
                <div class="form-group">
                    <label for="billingDate">Billing Date</label>
                    <input type="text" name="billing_date" id="billingDate" value="<?= date("m/d/Y") ?>"
                           class="text-warning font-weight-bold" readonly>
                </div>
                <div class="form-group">
                    <label for="billingAmount">Billing Amount</label>
                    <input type="text" name="billing_amount" id="billingAmount" value="<?= $data['rent_per_day'] ?>"
                           class="text-warning font-weight-bold" readonly>
                </div>
                <div class="form-group">
                    <label for="inputDays">Booking Days</label>
                    <select class="custom-select custom-select-lg mb-3" id="inputDays" name="input_days">
                        <option value="1" selected>One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                        <option value="4">Four</option>
                        <option value="5">Five</option>
                        <option value="6">Six</option>
                    </select>
                </div>

                <!-- DATE PICKER-->
                <div mbsc-page class="demo-range-select">
                    <label for="demo-range-selection" class="font-weight-bold">Select Your Dates</label>
                    <div style="height: 100%">
                        <div id="demo-range-selection"></div>
                    </div>
                </div>
                <!--DATE PICKER END-->
                <button type="button" class="btn btn-warning" id="submit">Submit</button>
            </form>
        </div>
    </section>
    <!--    BOOKING SECTION END-->
</div>
<!--CONTAINER END-->

<a class="btn btn-outline-primary" href="../auth/customer_logout.php">logout</a>


<!--RESOURCES CDN-->
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Bootstrap 4 JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Bootstrap Datepicker JS -->
<script>

    let billingAmount = document.getElementById("billingAmount");
    //THIS OBJECT TAKES ALL SELECTED DATES INSIDE THE ARRAY
    let datesArray=[];

    //GET NUMBER OF DAYS FROM THE DAYS INPUT BOX
    let inputDays = document.getElementById("inputDays");
    inputDays.addEventListener("blur", () => {
        passData.selectMax = inputDays.value;
        console.log(inputDays.value);
        console.log(passData.selectMax);
        mobiscroll.datepicker("#demo-range-selection", passData);
    });

    //PASS THIS OBJECT INSIDE THE DATE-PICKER OBJECT
    let passData = {
        controls: ["calendar"], // More info about controls: https://docs.mobiscroll.com/5-18-1/javascript/calendar#opt-controls
        display: "inline", // Specify display mode like: display: 'bottom' or omit setting to use default
        selectMultiple: true,
        selectMax: 1,
        selectCounter: true,
        showRangeLabels: true,
        dateFormat: 'DD/MM/YYYY',
        locale: mobiscroll.locale['en'],
        returnFormat: "locale",
        invalid: ["12-08-2022"],
        onChange: function (event, inst) {
            console.log(inst.getTempVal());
            datesArray = inst.getTempVal();
            billingAmount.value = (datesArray.length * <?=$data['rent_per_day']?>);
        }
    };

    //SET OPTION FOR DATE PICKER
    mobiscroll.setOptions({
        locale: mobiscroll.localeEn, // Specify language like: locale: mobiscroll.localePl or omit setting to use default
        theme: "ios", // Specify theme like: theme: 'ios' or omit setting to use default
        themeVariant: "dark", // More info about themeVariant: https://docs.mobiscroll.com/5-18-1/javascript/calendar#opt-themeVariant
    });

    //INSTANTIATE TO THE DATE PICKER
    mobiscroll.datepicker("#demo-range-selection", passData);

    // FORM VALIDATIONS
    let submitBtn = document.getElementById("submit");
    submitBtn.addEventListener('click', () => {
        submitBtn.disabled = true;
        if(datesArray.length===0){
            alert("kindly select at least one dates for booking!");
        }else{
            //CALL BOOKING API
            // IF SUCCESS THEN REDIRECT TO SHOW_BOOKING COMPONENT
            doBooking().then(data=>{
                console.log(data);
            })

        }
        setTimeout(() => {
            submitBtn.disabled = false;
        },3000)
    })

    async function doBooking(){
        let url = "http://localhost:80/rentalcar/api/customer/booking_api.php";
        let customerId;
        let vehicleId;
        let bookingDates;
        let days;
        let billingAmount;
        let sendData={
            "customer_id": "test@gmail.com",
            "vehicle_id": "6",
            "booking_date": [
                "12/08/2022",
                "13/08/2022"
            ],
            "days": "2",
            "billing_amount": "2000"
        }
        let payload ={
            method:'POST',
            cache:'no-cache',
            headers:{
                'Content-type':'application/json'
            },
            body :JSON.stringify(sendData)
        }
        const response = await fetch(url,payload);
        return response.json();
    }

</script>
</body>
</html>
<?php } ?>
