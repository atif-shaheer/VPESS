<!-- <!DOCTYPE html>
<html>
<head>
	<title>Blurred Background Image Page</title>
	<style>
		body {
			background-image: url('https://www.vandelaydesign.com/wp-content/uploads/27-2.jpg');
			background-size: cover;
			background-position: center;
			height: 100vh;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			backdrop-filter: blur(5px);
			-webkit-backdrop-filter: blur(5px);
		}

		h1 {
			color: white;
			font-size: 3rem;
			margin-bottom: 2rem;
			text-shadow: 2px 2px #000000;
		}

		button {
			background-color: #4CAF50;
			color: white;
			padding: 1rem 2rem;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			margin: 0.5rem;
			font-size: 1.2rem;
			box-shadow: 2px 2px 5px #000000;
			transition: all 0.3s ease;
		}

		button:hover {
			background-color: #3e8e41;
			box-shadow: 2px 2px 10px #000000;
			transform: scale(1.1);
		}
	</style>
</head>
<body>
	<h1>Welcome to my page</h1>
	<button>Button 1</button>
	<button>Button 2</button>
	<button>Button 3</button>
</body>
</html> -->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VPESS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/Capture-removebg-preview-removebg-preview (1).png' />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        /* Add a blur effect to the background */
        body {
            /* background-image: url("https://www.vandelaydesign.com/wp-content/uploads/27-2.jpg"); */
            /* filter: blur(8px);
            -webkit-filter: blur(8px); */
            background-size: cover;
            background-position: center center;
            height: 100%;
        }
        /* Add padding to the top bar */
        .top-bar {
            padding: 20px;
        }
        /* Style the small image */
        .small-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 10px;
        }
        /* Add margin to the content */
        .content {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        /* Style the buttons */
        .btn {
            margin-right: 10px;
            margin-bottom: 10px;
        }
        .blink {
            animation: blink 6s infinite;
            font-family: 'Helvetica', sans-serif;
            font-size: 28px;
            font-weight: bold;
            text-shadow: 1px 1px #FF0000, 2px 2px #FF7F00, 3px 3px #FFFF00, 4px 4px #00FF00, 5px 5px #0000FF, 6px 6px #8B00FF;
            }

            @keyframes blink {
            50% {
                color: #ffffff;
                background-color: #ff8c00;
            }
        }

        .designation {
            background-color: #f7f7f7;
            padding: 10px;
        }

        footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa;
            color: #333;
            text-align: center;
            padding: 20px;
        }

        #area-head-btn.clicked {
            animation-name: button-clicked;
            animation-duration: 0.5s;
            animation-timing-function: ease-out;
        }

        #customer.clicked {
            animation-name: button-clicked;
            animation-duration: 0.5s;
            animation-timing-function: ease-out;
        }

        #engineer.clicked {
            animation-name: button-clicked;
            animation-duration: 0.5s;
            animation-timing-function: ease-out;
        }

        #traineeengg.clicked {
            animation-name: button-clicked;
            animation-duration: 0.5s;
            animation-timing-function: ease-out;
        }

        @keyframes button-clicked {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(0.9);
            }
            100% {
                transform: scale(1);
            }
        }


    </style>
</head>
<body>
    <!-- Top bar with small image and content -->
    <div class="top-bar bg-light">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <img src="Capture-removebg-preview-removebg-preview (1).png" alt="Small image" class="small-image">
                <span class="blink">Welcome to VPESS</span>
            </div>
            <!-- <div>
                <button type="button" class="btn btn-primary">Button 1</button>
                <button type="button" class="btn btn-secondary">Button 2</button>
            </div> -->
        </div>
    </div>

    <!-- Additional content -->
    <div class="container content">
        <!-- <h1>Page content</h1>
        <p class="designation">Choose Your Designation</p> -->

        <div class="row">
            <div class="col-sm-3">
                <a id="area-head-btn" type="button" class="btn btn-primary btn-block" style="border-color: #fd5700;background-color: #fd5700;">
                    Area Head
                </a>
            </div>
            <div class="col-sm-3">
                <button id="customer" type="button" class="btn btn-primary btn-block" style="border-color: #fd5700;background-color: #fd5700;">
                    Customer
                </button>
            </div>
            <div class="col-sm-3">
                <button id="engineer" type="button" class="btn btn-primary btn-block" style="border-color: #fd5700;background-color: #fd5700;">
                    Engineer
                </button>
            </div>
            <div class="col-sm-3">
                <button id="traineeengg" type="button" class="btn btn-primary btn-block" style="border-color: #fd5700;background-color: #fd5700;">
                    Trainee Enggineer
                </button>
            </div>
            <div class="col-sm-3">
                <button type="button" class="btn btn-primary btn-block" style="border-color: #fd5700;background-color: #fd5700;">
                    Project Engineer
                </button>
            </div>
            <div class="col-sm-3">
                <button type="button" class="btn btn-primary btn-block" style="border-color: #fd5700;background-color: #fd5700;">
                    Relational Manager
                </button>
            </div>

        </div>
    </div>

    <footer>
        All Right Reserved By VPESS And Developed & Designed by <a style="color:#fc5700;" href="http://www.digitalhousetechnology.com" target="_blank">Digital House Technology</a>
  </footer>

  <script type="text/javascript">
        $(document).ready(function() {
        $('#area-head-btn').click(function() {
            $(this).addClass('clicked');
            setTimeout(function() {
                window.location.href = 'AreaHead/areaheadlogin.php';
            }, 500);
        });
    });
    $(document).ready(function() {
        $('#customer').click(function() {
            $(this).addClass('clicked');
            setTimeout(function() {
                window.location.href = 'Customer/customerlogin.php';
            }, 500);
        });
    });
    $(document).ready(function() {
        $('#engineer').click(function() {
            $(this).addClass('clicked');
            setTimeout(function() {
                window.location.href = 'engineers/engineerslogin.php';
            }, 500);
        });
    });
    $(document).ready(function() {
        $('#traineeengg').click(function() {
            $(this).addClass('clicked');
            setTimeout(function() {
                window.location.href = 'engineers/engineerslogin.php';
            }, 500);
        });
    });
  </script>
</body>
</html>