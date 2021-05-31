 <!-- <table>
                        <tr>
                            <td>
                                <p>Όνομα</p>
                            </td>

                            <td>
                                <p><?php if (!empty($_SESSION['first_name'])) : ?>
                                        <input type="text" name="firstname" placeholder="Όνομα" value="<?php echo $_SESSION['firstname'] ?>" required>
                                        <?php else : ?> <input type="text" style="font-weight:bold;" placeholder="Όνομα">
                                    <?php endif; ?>
                                </p>
                            </td>

                            <td style="padding-left: 20px">
                                <p>Επώνυμο</p>
                            </td>
                            <td>
                                <p><?php if (!empty($_SESSION['last_name'])) : ?>
                                        <input type="text" name="lastname" placeholder="Επώνυμο" value="<?php echo $_SESSION['lastname'] ?>" required>
                                    <?php else : ?>
                                        <input type="text" style="font-weight:bold;" placeholder="Επώνυμο">
                                    <?php endif; ?>
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p>Κινητό</p>
                            </td>
                            <td>
                                <p><input type="text" name="mobile_number" placeholder="Κινητό" required></p>
                            </td>
                            <td style="padding-left: 20px">
                                <p>Email</p>
                            </td>
                            <td>
                                <p><?php if (!empty($_SESSION['email'])) : ?>
                                        <input type="text" name="email" placeholder="Email" value="<?php echo $_SESSION['email'] ?>" required>
                                    <?php else : ?>
                                        <input type="text" name="email" placeholder="Email">
                                    <?php endif; ?>
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p>Διεύθυνση</p>
                            </td>
                            <td>
                                <p><?php if (!empty($_SESSION['address'])) : ?>
                                        <input type="text" name="address" placeholder="Διεύθυνση" value="<?php echo $_SESSION['address'] ?>" required>
                                    <?php else : ?>
                                        <input type="text" name="address" placeholder="Διεύθυνση">
                                    <?php endif; ?>
                                </p>
                            </td>
                            <td style="padding-left: 20px">
                                <p>Τ.Κ.</p>
                            </td>
                            <td>
                                <p><input type="text" name="tk" placeholder="Τ.Κ." required></p>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <p>Πόλη</p>
                            </td>
                            <td>
                                <p><input type="text" name="city" placeholder="Πόλη" required></p>
                            </td>
                            <td style="padding-left: 20px">
                                <p>Νομός</p>
                            </td>
                            <td>
                                <p>
                                    <select name="nomos">
                                        <option value="attikis" selected>Αττικής</option>
                                        <option value="thessalonikis">Θεσσαλονίκης</option>
                                        <option value="achaias">Αχαϊας</option>
                                        <option value="larisas">Λάρισας</option>
                                    </select>
                                </p>
                            </td>
                        </tr>
                    </table>

                    <table>
                        <tr>
                            <td valign="top">
                                <p>Αποστολή</p>
                            </td>
                            <td style="padding-left: 10px">
                                <p style="vertical-align: bottom">
                                    <input type="radio" name="tropos_apostolis" checked="checked"> Παραλαβή από το κατάστημα<br>
                                    <input type="radio" name="tropos_apostolis"> Παράδοση με δική μας μεταφορική ή courier<br>
                                    <input type="radio" name="tropos_apostolis"> Παράδοση με μεταφορική ή courier της επιλογής σας
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <p>Πληρωμή</p>
                            </td>
                            <td style="padding-left: 10px">
                                <p style="vertical-align: bottom">
                                    <input type="radio" name="tropos_plhrwmhs" checked="checked"> Πιστωτική, Χρεωστική ή Προπληρωμένη Κάρτα Online<br>
                                    <input type="radio" name="tropos_plhrwmhs"> Τραπεζική κατάθεση<br>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <p>Σχόλια</p>
                            </td>
                            <td style="padding-left: 10px">
                                <p><textarea name="sxolia" rows="2" cols="60" maxlength="255" style="resize: none" placeholder="Πληκτρολογήστε σχόλια εδώ"></textarea></p>
                            </td>
                        </tr>
                    </table>


                    <table>
                        <tr>
                            <td style="padding-left: 85px">
                                <p><input type="checkbox" id="myCheck" required></p>
                            </td>
                            <td style="padding-left: 5px">
                                <p style="font-size: 15px">
                                    Συμφωνώ με τους όρους χρήσης και την πολιτική απορρήτου
                                </p>
                            </td>
                        </tr>
                    </table>

                    <table style="margin-left: 85px">
                        <tr>
                            <td style="padding-left: 100px">
                                <input type="submit" value="Υποβολή" name="submit-order">
                            </td>
                            <td style="padding-left: 50px">
                                <input type="submit" value="Αρχικοποίηση" name="arxikopoihsh">
                            </td>
                        </tr>
                    </table> -->