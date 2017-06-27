<?php

?>

<form class="feedback-form">
    <h4>Контактна форма для зв'язку з нами:</h4>
    <div class="form-group">
        <label for="name">Ваше ім'я</label>
        <input type="text" class="form-control" id="name" required>
    </div>
    <div class="form-group">
        <label for="contacts">Контактні дані (телефон, ел.пошта)</label>
        <input type="text" class="form-control" id="contacts" required>
    </div>
    <div class="form-group">
        <label for="exampleTextarea">Повідомлення</label>
        <textarea class="form-control" id="exampleTextarea" rows="5" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Надіслати</button>
</form>