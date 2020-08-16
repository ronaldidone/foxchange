<?php foreach($chat_mensajes as $msj): ?>
    <?php if($msj["id_user"]==$user_id): ?>
        <div class="card bg-primary rounded w-75 float-right z-depth-0 mb-2">
            <div class="card-body p-2">
                <p class="card-text text-white"><b><?php echo $msj["fecha_hora"];?></b><br><?php echo $msj["message"];?></p>
            </div>
        </div>
    <?php else: ?>
        <div class="card bg-light rounded w-75 z-depth-0 mb-1 message-text">
        <div class="card-body p-2">
            <p class="card-text black-text"><b><?php echo $msj["fecha_hora"];?></b><br><?php echo $msj["message"];?></p>
        </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>