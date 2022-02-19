<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <title>App Salón</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/build/css/app.css">

</head>

<body>

    <div class="contenedor-app">

            <!-- modal -->
            <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <!-- carousel -->
                            <div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>
                                <div class='carousel-inner'>

                                </div>
                                <a class='carousel-control-prev' href='#carouselExampleIndicators' role='button' data-slide='prev'>
                                    <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                                    <span class='sr-only'>Previous</span>
                                </a>
                                <a class='carousel-control-next' href='#carouselExampleIndicators' role='button' data-slide='next'>
                                    <span class='carousel-control-next-icon' aria-hidden='true'></span>
                                    <span class='sr-only'>Next</span>
                                </a>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>




        <div class="imagen">

            <div class="datos">
                <div class="horarios">
                    
                </div>
                <div class="direccion">

                </div>
                <div class="redes">
                    <a href="https://www.facebook.com/"><img src="/build/img/facebook.png"></a>
                    <a href="https://www.instagram.com/"><img src="/build/img/instagram.png"></a>
                    <a href="https://www.whatsapp.com/"><img src="/build/img/whatsapp.png"></a>
                </div>
            </div>


        </div>
        <div class="app">

            <?php echo $contenido; ?>
        </div>
    </div>

    <?php echo $script ?? ''; ?>

</body>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

</html>