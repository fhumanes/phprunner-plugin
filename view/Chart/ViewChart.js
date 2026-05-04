/**
 * Example for view control control class
 */
Runner.viewControls.ViewChart = Runner.extend(Runner.viewControls.ViewControl, {

    /**
     * Override constructor
     * @param {Object} cfg
     */
    constructor: function (cfg) {
        // call parent
        Runner.viewControls.ViewChart.superclass.constructor.call(this, cfg);
       

    },
    initChart:function(){
        var data, type, id;
        $("[id^=chart_container][data-fieldname='" + this.goodFieldName + "']:not([data-initialized])").each(function () {

            // mark this control as initialized
            $(this).attr('data-initialized', '');

            // read attributes
            data = jQuery.parseJSON($(this).attr("data-data"));
            type = $(this).attr("data-type");
            title = $(this).attr("data-title");
            id = $(this).attr("id");
            // create charts
            if (type == "column") {
                // column chart
                var chartColumn = anychart.column();
                var seriesColumn = chartColumn.column(data);
                chartColumn.container(id);
                chartColumn.title(title);
                chartColumn.draw();
            } else if (type == "line") {
                // line chart
                var linechart = anychart.line();
                var seriesLine = linechart.line(data);
                linechart.container(id);
                linechart.title(title);
                linechart.draw();
            } else if (type == "bar") {
                // bar chart
                var barchart = anychart.bar();
                var series = barchart.bar(data);
                barchart.container(id);
                barchart.title(title);
                barchart.draw();
            } else if (type == "bar3d") {
                // bar3d chart
                var barchart3d = anychart.bar3d();
                var series = barchart3d.bar(data);
                barchart3d.container(id);
                barchart3d.title(title);
                barchart3d.draw();
            } else if (type == "pie") {
                // pie chart
                var piechart = anychart.pie(data);
                piechart.container(id);
                piechart.innerRadius("30%");
                piechart.title(title);
                piechart.draw();
            }
        });
    },
    init: function () {
        var viewChart = this;
        var anychart_scripts = ["https://cdn.anychart.com/releases/8.11.1/js/anychart-base.min.js"];
        if(this.type == "bar3d"){
            anychart_scripts.push("https://cdn.anychart.com/releases/8.11.1/js/anychart-core.min.js");
            anychart_scripts.push("https://cdn.anychart.com/releases/8.11.1/js/anychart-cartesian-3d.min.js");
        }
        loadScripts();
        function loadScripts(){
            var scripts = [],anychart_length; 
            scripts.push( anychart_scripts.shift() );
            anychart_length = anychart_scripts.length;
            Runner.util.ScriptLoader.addJS(scripts);
            Runner.util.ScriptLoader.onFilesLoaded(function () {
                if(anychart_length == 0){
                    anychart.licenseKey(Runner.anychartLicense);
                    viewChart.initChart();
                }
          
                else
                    loadScripts();
      
            });
            Runner.util.ScriptLoader.load();
        }

    }
});