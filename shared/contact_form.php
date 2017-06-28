<?php

?>

<form class="feedback-form" id="feedback-form" onsubmit="sendMessage(event)">
    <h4>Контактна форма для зв'язку з нами:</h4>
    <div class="form-group">
        <label for="feedback-form-name">Ваше ім'я</label>
        <input id="feedback-form-name" maxlength="100" name="name" type="text" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="feedback-form-contacts">Контактні дані (телефон, ел.пошта)</label>
        <input id="feedback-form-contacts" maxlength="100" name="contacts" type="text" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="feedback-form-message">Повідомлення</label>
        <textarea id="feedback-form-message" name="message" class="form-control" rows="5" required></textarea>
    </div>
    <button id="feedback-form-submit-btn" type="submit" class="btn-marg btn btn-primary">Надіслати</button>
    <p id="feedback-form-feedback" class="alert alert-success"></p>
</form>