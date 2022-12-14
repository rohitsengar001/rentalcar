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
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link
            rel="stylesheet"
            type="text/css"
            href="https://npmcdn.com/flatpickr/dist/themes/dark.css"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
          integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
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

        .event {
            position: absolute;
            width: 3px;
            height: 3px;
            border-radius: 150px;
            bottom: 3px;
            left: calc(50% - 1.5px);
            content: " ";
            display: block;
            background: #3d8eb9;
        }

        .event.busy {
            background: #f64747;
        }

    </style>
</head>

<body>
<?php include './navbar.php';
function load($data, $booked_dates): void
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
                <label for="demo-range-selection">Select Booking Dates</label>
                <div class="input-group mb-3">
                    <input type="date" class="form-control" id="demo-range-selection" placeholder="select Dates...."/>
                    <span class="input-group-text" id="calendarButton"><i class="fa-solid fa-calendar-days"></i></span>
                </div>

                <!--DATE PICKER END-->
                <button type="button" class="btn btn-warning" id="submit">Submit</button>
            </form>
        </div>
    </section>
    <!--    BOOKING SECTION END-->
</div>
<!--CONTAINER END-->


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
    let datesArray = [];

    //GET PREVIOUS DATE
    function getPreviousDay(date = new Date()) {
        const previous = new Date(date.getTime());
        previous.setDate(date.getDate());

        return previous;
    }

    let bookedDates = <?= $booked_dates ?>;

    //GET NUMBER OF DAYS FROM THE DAYS INPUT BOX
    let days = document.getElementById("inputDays");
    days.addEventListener("blur", () => {
        console.log('blur days button');
        flatpickr('#demo-range-selection', passData);
    });

    //PASS THIS OBJECT INSIDE THE DATE-PICKER OBJECT
    let prevDate;
    let count = 1;
    let passData = {
        mode: 'multiple',
        dateFormat: 'd/m/Y',
        minDate: 'today',
        maxDate: new Date().fp_incr(60),
        disable: bookedDates,
        onDayCreate: function (dObj, dStr, fp, dayElem) {
            //logic for busy event represent
            if (bookedDates.length > 0) {
                // get days, months and years
                // Utilize dayElem.dateObj, which is the corresponding Date
                let getD = parseInt(dayElem.dateObj.getDate());
                let getM = parseInt(dayElem.dateObj.getMonth());
                let getY = parseInt(dayElem.dateObj.getFullYear());

                //iterate each reserved date
                bookedDates.forEach((date) => {
                    //get days , months and years from reserved date
                    let splitedDateArray = date.toString().split('/');
                    let reserveDate = +(splitedDateArray[0]);
                    let reserveMonth = +(splitedDateArray[1]);
                    let reserveYear = +(splitedDateArray[2]);
                    if ((reserveDate === getD && reserveMonth === getM + 1 && reserveYear === getY)) {
                        console.log("=>", reserveYear, getY);
                        dayElem.innerHTML += "<span class='event busy'></span>";
                    }
                })
            }

        },
        onChange: function (selectedDates, dateStr, instance) {
            let inputDatesArray = dateStr.split(',');
            let dateLen = inputDatesArray.length;
            console.log(dateLen, days.value);
            if (dateLen <= parseInt(days.value)) {
                console.log("true")
                prevDate = inputDatesArray;
                datesArray = inputDatesArray;
            } else {
                console.log('false');
                let msg = `can not be selected more than ${days.value}`;
                alert(msg)
                instance.setDate(prevDate);
                datesArray = prevDate;
            }
            billingAmount.value = (datesArray.length * <?=$data['rent_per_day']?>);
        },
    };

    // datepicker instance
    let calendar = flatpickr('#demo-range-selection', passData);
     flatpickr('#calendarButton', passData);


    // FORM VALIDATIONS ON SUBMIT BUTTON
    let submitBtn = document.getElementById("submit");
    submitBtn.addEventListener('click', () => {
        submitBtn.disabled = true;
        if (datesArray.length === 0) {
            alert("kindly select at least one dates for booking!");
        } else {
            //CALL BOOKING API
            // IF SUCCESS THEN REDIRECT TO SHOW_BOOKING COMPONENT
            doBooking().then(data => {
                console.log(data);
                setTimeout(() => {
                    window.location = `./success_component.php?booking_nums=${datesArray.length}`;
                }, 2000);
            })
        }
        setTimeout(() => {
            submitBtn.disabled = false;
        }, 3000)
    })

    async function doBooking() {
        let url = "http://localhost:80/rentalcar/api/customer/booking_api.php";
        let customerId = "<?= $_SESSION['customer']?>";
        let vehicleId = "<?= $_GET['vehicleid']?>";
        let bookingDates = datesArray;
        let days = document.getElementById("inputDays").value;
        let billingAmount = (document.getElementById("billingAmount").value) / datesArray.length;
        let sendData = {
            "customer_id": customerId,
            "vehicle_id": vehicleId,
            "booking_date": bookingDates,
            "days": days,
            "billing_amount": billingAmount.toString()
        }
        let payload = {
            method: 'POST',
            cache: 'no-cache',
            headers: {
                'Content-type': 'application/json'
            },
            body: JSON.stringify(sendData)
        }
        const response = await fetch(url, payload);
        return response.json();
    }

</script>
</body>
</html>
<?php } ?>
