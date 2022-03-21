$(function(){

  'use strict'

  /************************ BAR CHART 1 *************************/
  var chartdata = [
    {
      name: 'Motor',
      type: 'bar',
      data: [20, 20, 36, 12, 15,2, 20, 36, 12, 15,19,5],
      label: 'Motor',
      color: '#b21818'
    },
    {
      name: 'Health',
      type: 'bar',
      data: [8, 5, 25, 10, 10,30, 15, 25, 10, 1,31,30],
      label: 'Health',
      color: '#121c4a'
    }
  ];

  var chart = document.getElementById('chartBar1');
  var barChart = echarts.init(chart);

  var option = {
    grid: {
      top: '6',
      right: '0',
      bottom: '17',
      left: '25',
    },
    xAxis: {
      data: [ 'Jan', 'Fab', 'Mar', 'Apr', 'May','Jun','Jul','Aug','Sep','Nov','Dec'],
      axisLine: {
        lineStyle: {
          color: '#ccc'
        }
      },
      axisLabel: {
        fontSize: 10,
        color: '#666'
      }
    },
    yAxis: {
      splitLine: {
        lineStyle: {
          color: '#ddd'
        }
      },
      axisLine: {
        lineStyle: {
          color: '#ccc'
        }
      },
      axisLabel: {
        fontSize: 10,
        color: '#666'
      }
    },
    series: chartdata
  };

  barChart.setOption(option);
  
  
  
  
  
  /********************* PIE CHART *********************/

  var sum = function(a, b) { return a + b };

  var data = {
    series: [5, 3, 4]
  };

  var pie1 = new Chartist.Pie('#chartPie1', data, {
    labelInterpolationFnc: function(value) {
      return Math.round(value / data.series.reduce(sum) * 100) + '%';
    }
  });

  /**************** PIE CHART 2 *******************/

  var data2 = {
    series: [5, 3, 4, 6, 2]
  };

  var pie2 = new Chartist.Pie('#chartPie2', data2, {
    labelInterpolationFnc: function(value) {
      return Math.round(value / data.series.reduce(sum) * 100) + '%';
    }
  });


  // resize chart when container changest it's width
  new ResizeSensor($('.br-mainpanel'), function(){
    pie1.update();
    pie2.update();
  });
  
});