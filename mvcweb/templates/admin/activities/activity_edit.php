<?php
require_once("activities_categories.php");

$code = $_GET['code'];
$id = $_GET['id'];

$title = "New Activity";
$description = "";
$start_date = "";
$end_date = "";
$currency = "0";
$price = "";
$tags = "";
$frequency = "weekly"; // once / daily / weekly / monthly
$day_of_week = "0"; // sunday
$photo = "/wp-content/plugins/mvcweb/assets/images/NO_IMG.png";
$photo_map = "";
$photo_map_x = "50";
$photo_map_y = "50";
$resort_index = new SimpleXMLElement(get_option("MVC_RESORTS_INDEX"));
$time_of_day = "12:00 PM";
$reservations = "yes";
$phone = "";
$active = "no";

$resort = $resort_index->xpath("//resort[@code='" . $code . "']");

if ($_GET["clone"]) {
    $id = $_GET["clone"];
    $lookup_code = "admin";
} else {
    $lookup_code = $code;
}


if ($id) {
    $resort_xml = new SimpleXMLElement(get_option("MVC_OSA_" . $lookup_code));
    $activity = $resort_xml->xpath("//Row[@id='" . $id . "']")[0];

    $title = $activity->xpath("ActivityTitle")[0];
    $description = $activity->xpath("ActivityDescription")[0];
    $start_date = $activity->xpath("startDate")[0];
    $end_date = $activity->xpath("endDate")[0];
    $currency = $activity->xpath("currency")[0];
    $price = $activity->xpath("currencyPrice")[0];
    $tags = $activity->xpath("tags")[0];
    $frequency = $activity->xpath("frequency")[0];
    $day_of_week = $activity->xpath("dayOfWeek")[0];
    $photo = $activity->xpath("photo")[0];
    $photo_map = $activity->xpath("photo_map")[0];
    $photo_map_x = $activity->xpath("photo_map_x")[0];
    $photo_map_y = $activity->xpath("photo_map_y")[0];
    $time_of_day = $activity->xpath("timeOfDay")[0];
    $reservations = $activity->xpath("reservations")[0];
    $phone = $activity->xpath("ActivityPhone")[0];
    $active = $activity->xpath("active")[0];
}

function filter_check($tags, $tag, $title)
{
    return "<input type='checkbox' name='cat_" . $tag . "' " . ((strpos($tags, $tag) !== false) ? "checked='checked'" : "") . "/> " . $title . "<br/>";
}

function option_check($value, $title, $check)
{
    return "<option value='" . $value . "'" . ($check == $value ? " selected" : "") . ">" . $title . "</option>";
}

?>
<style>

    form input, form textarea {
        width: 400px;
    }

    table {
        padding-left: 2rem;
    }

    table td {
        padding-bottom: 1rem;
    }

</style>
<div style="float:right; margin-right:50px; margin-top:50px;">
    Templates: <select name="templates" id="template_list">
        <?php

        foreach ($GLOBALS["activities_categories_" . strtolower($code)] as $key => $category) { ?>
            <option value="" disabled><?php echo $key; ?></option>
            <?php foreach ($category as $subkey => $subcategory) { ?>
                <option value="" disabled>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $subcategory; ?></option>
                <?php
                $templates_master = new SimpleXmlElement(get_option("MVC_OSA_admin"));
                foreach ($templates_master->xpath("//Row") as $template) {
                    if (strpos($template->xpath("tags")[0], $subkey) !== false) {
                        ?>
                        <option value="<?php echo $template->xpath("@id")[0]; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $template->xpath("ActivityTitle")[0]; ?></option>
                    <?php }
                }
            }
        }

        $templates = new SimpleXmlElement(get_option("MVC_OSA_admin"));
        ?>
    </select>
</div>
<div style="margin-top:20px;"><a href="admin.php?page=mvc_activities_edit&code=<?php echo $_GET["code"]; ?>">&lt;
        Back</a></div>
<h1><?php echo $resort[0]; ?></h1>
<h2>Activity: <?php echo $title; ?></h2>
<form id="form" action="admin-post.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="activity_edit_form"/>
    <input type="hidden" name="code" value="<?php echo $code; ?>"/>
    <input type="hidden" name="photo_url" value="<?php echo $photo; ?>"/>
    <input type="hidden" name="photo_map_url" value="<?php echo $photo_map; ?>"/>
    <input type="hidden" name="photo_map_x" value="<?php echo $photo_map_x; ?>"/>
    <input type="hidden" name="photo_map_y" value="<?php echo $photo_map_y; ?>"/>
    <?php if ($id && !$_GET["clone"]) { ?>
        <input type="hidden" name="id" id="activity_id" value="<?php echo $id; ?>"/>
    <?php } ?>

    <table class="activity_form">
        <tr>
            <td>
                Title:
            </td>
            <td>
                <input type="text" name="title" value="<?php echo htmlspecialchars($title, ENT_QUOTES); ?>"/>
            </td>
        </tr>
        <tr>
            <td>
                Description:
            </td>
            <td>
                <textarea name="description"><?php echo htmlspecialchars($description, ENT_QUOTES); ?></textarea>
            </td>
        </tr>
        <tr>
            <td>
                Photo:
            </td>
            <td>
                <img id="photo_top" height="300" src="<?php echo $photo; ?>"/><br/>
                <input type="file" name="photo" id="imgInputPhoto"/>
            </td>
        </tr>
        <tr>
            <td>
                Location:
            </td>
            <td>
                <div id="wrapper_location" style="position: relative;display: inline-block;">
                    <img id="photo_map" style="max-width: 600px;" src="<?php echo $photo_map; ?>"/><br/>
                    <?php if (!empty($photo_map)) { ?>
                        <img id="pin" src="/wp-content/plugins/mvcweb/assets/images/pin.png"
                             style="position: absolute;top: <?php echo $photo_map_y; ?>%;left: <?php echo $photo_map_x; ?>%;width: 16px;">
                    <?php } else { ?>
                        <img id="pin" src="/wp-content/plugins/mvcweb/assets/images/pin.png"
                             style="position: absolute;top: <?php echo $photo_map_y; ?>%;left: <?php echo $photo_map_x; ?>%;display:none; width: 16px;">
                    <?php } ?>
                </div>
                <input style="display: block;" type="file" name="photo_map" id="imgInputMap"/>
            </td>
        </tr>
        <tr>
            <td>
                Start Date &amp; Time:
            </td>
            <td>
                <input type="text" name="startDate" class="datetime_picker" value="<?php echo $start_date; ?>"
                       readonly="readonly" required/>
            </td>
        </tr>
        <tr>
            <td>
                End Date:
            </td>
            <td>
                <span class="warning-message" style="display: none; color: red;">End date is required</span>
                <input type="text" name="endDate" class="date_picker" value="<?php echo $end_date; ?>"
                       readonly="readonly"/>
            </td>
        </tr>
        <tr>
            <td>
                Frequency:
            </td>
            <td>
                <select name="frequency" class="frequency_dropdown">
                    <?php
                    echo option_check("single", "Single Date", $frequency);
                    echo option_check("daily", "Daily", $frequency);
                    echo option_check("weekly", "Weekly", $frequency);
                    ?>
                </select>
                <div id="day_of_week_container">
                </div>
                <div id="day_of_week_add" style='display: none;'>
                    <a href="javascript:addDayOfWeek();" style=" text-decoration: none; font-size:30px">+</a>
                </div>
                <input type="hidden" name="sortby" value="<?php echo $_GET['sortby']; ?>"/>
                <input type="hidden" name="dir" value="<?php echo $_GET['dir']; ?>"/>
                <input type="hidden" name="dayOfWeek" id="day_of_week_value" value="<?php echo $day_of_week; ?>"/>
                <div id="day_of_week_template" class="day_of_week_template" style="display:none;">
                    <select name="dayOfWeekSelect" class="frequency_suboption day_of_week">
                        <?php
                        echo option_check("0", "Sunday", $day_of_week);
                        echo option_check("1", "Monday", $day_of_week);
                        echo option_check("2", "Tuesday", $day_of_week);
                        echo option_check("3", "Wednesday", $day_of_week);
                        echo option_check("4", "Thursday", $day_of_week);
                        echo option_check("5", "Friday", $day_of_week);
                        echo option_check("6", "Saturday", $day_of_week);
                        ?>
                    </select>
                    <select name="hour" class="hour" required>
                        <?php for ($i = 1; $i <= 12; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                    :
                    <select name="minute" class="minute" required>
                        <?php for ($i = 0; $i < 60; $i += 15) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                    <select name="ampm" class="ampm">
                        <option value="am">AM</option>
                        <option value="pm">PM</option>
                    </select>
                    <a href="javascript:void(0);" onclick="javascript:removeDay();"
                       style="display: inline; text-decoration: none; font-size:30px">-</a>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                Requires Reservation:
            </td>
            <td>
                <input name="reservations" type="checkbox" <?php echo($reservations == "yes" ? "checked" : ""); ?>/>
            </td>
        </tr>
        <tr>
            <td>
                Active? :
            </td>
            <td>
                <input name="active" type="checkbox" <?php echo($active == "yes" ? "checked" : ""); ?>/>
            </td>
        </tr>
        <tr>
            <td>
                Filters:
            </td>
            <td>
                <?php
                foreach ($GLOBALS["activities_categories_" . strtolower($code)] as $key => $category) { ?>
                    <b><?php echo $key; ?></b><br/>
                    <?php foreach ($category as $subkey => $subcategory) {
                        echo filter_check($tags, $subkey, $subcategory);
                    }
                } ?>
            </td>
        </tr>
        <tr>
            <td>Price:
            </td>
            <td>
                <select name="currency">
                    <option value="$">$</option>
                    <option value="&euro;">&euro;</option>
                </select>
                <input type="text" name="price" value="<?php echo $price; ?>" style="width: 100px;"/>
            </td>
        </tr>
        <tr>
            <td>Phone</td>
            <td>
                <input type="tel" name="phone" value="<?php echo $phone; ?>">
            </td>
        </tr>
        <tr>
            <td>
                Save:
            </td>
            <td>
                <input id="Submit" type="submit" value="Submit"/>
            </td>
        </tr>
        <tr>
            <td>Actions:</td>
            <td>
                <a href="javascript:void(0);"
                   onclick="document.location.href='admin.php?page=mvc_activities_edit&code=<?php echo $_GET['code'] ?>';">Cancel</a>&nbsp;&nbsp;
                <a href="javascript:void(0);" onclick="deleteConfirm();">Delete</a>
            </td>
        </tr>
    </table>
</form>
<script type='text/javascript' src='/wp-content/plugins/mvcweb/assets/jquery/js/jquery-3.2.1.min.js?ver=4.9.8'></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type='text/javascript' src='/wp-content/plugins/mvcweb/assets/jquery-ui-1.12.1/jquery-ui.js'></script>

<script>
    function deleteConfirm() {
        if (confirm("Delete Activity?")) {

            dapi = api(<?php echo json_encode(get_site_url() . '/wp-admin/admin-post.php'); ?>, "POST", {
                action: "delete_activity",
                id: ($("#activity_id").val()),
                code: '<?php echo $_GET['code']; ?>'
            }, function (result) {
                document.location.href = 'admin.php?page=mvc_activities_edit&code=<?php echo $_GET['code']?>';
            });
        }
    }

    function rasterizeDayOfWeeks() {
        var days_array = [];
        var days = $("#day_of_week_container").find(".day_of_week_template").each(function (item) {
            var day_array = [];
            day_array.push($(this).find(".day_of_week").val());
            day_array.push(parseInt($(this).find(".hour").val()) + ($(this).find(".ampm").val() == "pm" ? 12 : 0));
            day_array.push($(this).find(".minute").val());
            days_array.push(day_array.join("/"));
        });
        $("#day_of_week_value").val(days_array.join("|"));
        console.log('456');
        return true;
    }

    function renderDayOfWeeks() {
        var container = $("#day_of_week_container").css({display: "block"});
        $("#day_of_week_add").css({display: "block"});
        var day_string = "<?php echo $day_of_week; ?>";
        var days = day_string.split("|");
        days.forEach(function (item) {
            var time = item.split("/");
            var template = $("#day_of_week_template").clone();
            template.attr("id", null);
            template.css({display: "block"});
            template.find(".day_of_week").val(time[0]);
            template.find(".hour").val((time[1] > 11 ? time[1] - 12 : time[1]));
            template.find(".minute").val(time[2]);
            template.find(".ampm").val((time[1] > 11 ? "pm" : "am"));
            container.append(template);
        });

    }

    function hideDayOfWeeks() {
        $("#day_of_week_container").html("");
        $("#day_of_week_container").css({display: "none"});
        $("#day_of_week_add").css({display: "none"});
    }

    $(document).ready(function () {
        $(".datetime_picker").flatpickr({enableTime: true});
        $(".date_picker").flatpickr();
        $(".frequency_dropdown").on("change", function (e) {
            switch ($(this).val()) {
                case "weekly":
                    renderDayOfWeeks();
                    break;
                default:
                    hideDayOfWeeks();
                    break;
            }
        });

        var form = document.querySelector('#form');
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            if ($("input[name^='endDate']").val() == "")
                $(".warning-message").css("display", "block");
            else {
                rasterizeDayOfWeeks();
                $("form").submit();
            }
        }, false);

        

        $("#template_list").on("change", function (e) {
            document.location.href = '?page=mvc_activity_edit&code=<?php echo $code; ?>&clone=' + $(this).val() + '&sortby=<?php echo $_GET['sortby'];?>&dir=<?php echo $_GET['dir']; ?>';
        });
    });

    if ($(".frequency_dropdown").val() == "weekly") {
        renderDayOfWeeks();
    }

    function removeDay(event) {
        if (!event) {
            event = window.event; // Older versions of IE use
                                  // a global reference
                                  // and not an argument.
        }
        ;

        var el = $(event.target || event.srcElement); // DOM uses 'target';
        // older versions of
        // IE use 'srcElement'
        el.parent().remove();
    }

    function addDayOfWeek() {
        var container = $("#day_of_week_container");
        var template = $("#day_of_week_template").clone();
        template.attr("id", null);
        template.css({display: "block"});
        container.append(template);
    }

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#photo_map').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);

        }
    }

    $("#imgInputMap").change(function () {
        readURL(this);
        $('#pin').css({'display': 'block'});

    });

    function readTopURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#photo_top').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);

        }
    }
    $("#imgInputPhoto").change(function () {
        readTopURL(this);

    });

    $("#pin").draggable({
        containment: "parent",
        delay: 300,
        stop: function () {

            var l = (100 * parseFloat($(this).position().left / parseFloat($(this).parent().width())));

            var t = (100 * parseFloat($(this).position().top / parseFloat($(this).parent().height())));

            $(this).css("left", l + "%");

            $(this).css("top", t + "%");

            $("input[name='photo_map_x']").val(l);
            $("input[name='photo_map_y']").val(t);

        }

    });
</script>
<script src="/wp-content/plugins/mvcweb/assets/javascript/utils.js"></script>
