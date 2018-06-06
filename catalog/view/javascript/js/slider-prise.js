	$(function () {

        $("#range").ionRangeSlider({
            hide_min_max: true,
            keyboard: true,
            min: 0,
            max: 12000,
            from: 500,
            to: 12000,
			min_interval: 3000,
            type: 'double',
            step: 1,
            prefix: "",
            grid: false
        });

    });