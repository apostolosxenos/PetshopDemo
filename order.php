<?php $user_data = get_user_details($db); ?>

<h5 class="mt-4 mb-5" style="color:rebeccapurple"><strong>Καταχώρηση Παραγγελίας</strong></h5>

<div class='edit-wrapper'>


    <!-- ORDER FORM -->
    <form name="orderForm" id="orderForm" action="<?php echo htmlspecialchars('/orders/submit_order.php') ?>" method="POST">
        <div class="left-side mr-5">
            <div class="form-group">
                <label>Όνομα</label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="<?php if (!empty($user_data['first_name'])) echo $user_data['first_name']; ?>">
                <span id="first_name_error"></span>
            </div>
            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php if (!empty($user_data['email'])) echo $user_data['email']; ?>">
                <span id="email_error"></span>
            </div>
            <div class="form-group">
                <label>Διεύθυνση</label>
                <input type="text" name="address" id="address" class="form-control" value="<?php if (!empty($user_data['address'])) echo $user_data['address']; ?>">
                <span id="address_error"></span>
            </div>
            <div class="form-group">
                <label>Πόλη</label>
                <input type="text" name="city" id="city" class="form-control" value="<?php if (!empty($user_data['city'])) echo $user_data['city']; ?>">
                <span id="city_error"></span>
            </div>
        </div>
        <div class="right-side">
            <div class="form-group">
                <label>Επώνυμο</label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="<?php if (!empty($user_data['last_name'])) echo $user_data['last_name']; ?>">
                <span id="last_name_error"></span>
            </div>
            <div class="form-group">
                <label>Τηλέφωνο Επικοινωνίας</label>
                <input type="text" name="mobile_number" id="mobile_number" class="form-control" value="<?php if (!empty($user_data['mobile_number'])) echo $user_data['mobile_number']; ?>">
                <span id="mobile_number_error"></span>
            </div>
            <div class="form-group">
                <label>T.K.</label>
                <input type="text" name="postal_code" id="postal_code" class="form-control" value="<?php if (!empty($user_data['postal_code'])) echo $user_data['postal_code']; ?>">
                <span id="postal_code_error"></span>
            </div>
            <div class="form-group">
                <label>Τρόπος Παραλαβής</label>
                <select class="form-control" name="delivery_method">
                    <option value="courier" selected>Αποστολή με courier</option>
                    <option value="shop">Παραλαβή από το κατάστημα</option>
                </select>
            </div>
            <label>Σχόλια για την Παραγγελία</label>
            <textarea class="form-control" rows=4 name="comments" id="comments"></textarea>
            <span id="comments_error"></span>
            <div class="form-group mt-4">
                <span class="text-center" id="empty-cart"></span>
                <button type="submit" id="submit_btn" class="form-control btn btn-primary btn-custom mt-2">ΚΑΤΑΧΩΡΗΣΗ</button>
            </div>
        </div>
    </form>
    <!-- ORDER FORM -->
</div>