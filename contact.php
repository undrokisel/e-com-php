<?php include ('layouts/header.php') ?>


<!-- contact -->
<section id="contact" class="container py-5 section-contacts">

    <div class="container text-center mt-5">

        <h4 class="text-danger text-big">
            <?php if (isset ($_GET['error'])) {
                echo $_GET["error"];
            } ?>
        </h4>
        <h4 class="text-success text-big">
            <?php if (isset ($_GET['contact_us_success'])) {
                echo "Ваше сообщение принято. <br/>В ближайшее время вам ответит наш менеджер";
            } ?>
        </h4>


        <h3 class="contacts-title">Контакты</h3>
        <hr class="mx-auto">


        <div class="contacts-body">

            <!-- контакты -->
            <div class="footer-one">
                <ul class="footer-contacts-list mx-auto">
                    <li class="d-flex gap-2 mx-auto">
                        <h6 class="">Адрес:</h6>
                        <p>г. Пермь, ул. Пушкина, д. 113:</p>
                    </li>
                    <li class="d-flex gap-2 mx-auto">
                        <h6 class="">Телефон:</h6>
                        <p>+7989898798:</p>
                    </li>
                    <li class="d-flex gap-2 mx-auto">
                        <h6 class="">Почта:</h6>
                        <p>alexandria@ya.com:</p>
                    </li>
                 

                </ul>
            </div>


            <div class="contacts-body-footer-blocks">
                <!-- карта -->
                <div class="contacts__map mb-4 pb-2">
                    <h4 class="question-title text-center"><b>Как добраться</b></h4>
                    <iframe class=""
                        src="https://yandex.ru/map-widget/v1/?ll=56.227424%2C58.004138&mode=poi&poi%5Bpoint%5D=56.221126%2C58.002848&poi%5Buri%5D=ymapsbm1%3A%2F%2Forg%3Foid%3D1064300558&z=16.58"
                        width="100%" height="99%" frameborder="0" allowfullscreen="true" style="position:relative;">
                    </iframe>
                </div>

                <!-- вопросы -->
                <div class="quesions">
                    <h4 class="question-title text-center"><b>Хотите задать вопрос?</b></h4>

                    <div class="h-100">

                        <div class="questions-form  h-100 min-w-300">

                            <form action="contact_us.php" method="POST" class="d-flex flex-column gap-2">
                                <div class="form-group">
                                    <input name="email" maxlength="25" type="email" placeholder="Введите email" required 
                                        class="form-control">
                                </div>
                                <div class="form-group d-flex flex-column">
                                    <textarea class="form-control" maxlength="200" name="question" id="" cols="30" required 
                                        rows="10" placeholder="Опишите ваш вопрос здесь"></textarea>
                                </div>

                                <div class="form-group mt-3">
                                    <button name="contact_us" type="submit"
                                        class="btn btn-primary w-100">Отправить</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>



        </div>



    </div>



</section>



<?php include ('layouts/footer.php') ?>