<?php

?>

<div class="subscribe-form">
    <form class="form-inline" onsubmit="onSubscribe(event)">
        <label for="subs-email" style="padding-right: 5px">Підписатись/Відписатися:</label>
        <input type="email" class="form-control mb-2 mr-sm-2 mb-sm-0" id="subs-email" placeholder="email..." required>

        <button type="submit" class="btn btn-primary" >ОК</button>
        <p id="suscribe-feedback" class="alert alert-success"></p>
    </form>
</div>

