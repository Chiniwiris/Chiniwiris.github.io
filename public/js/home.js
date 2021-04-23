const tl = gsap.timeline({ defaults: { ease: "power1.out" } });

window.addEventListener('load', function(){
    tl.to('.slider', {y: "-100%", duration: 1, delay: 1});
    new Glider(document.querySelector('.carousel__list'), {
        slidesToShow : 4,
        slidesToScroll : 4,
        draggable: true,
        dots: '.carousel__indicadores',
        arrows: {
            prev : '.carousel__prev',
            next: '.carousel__next'
        },
        responsive: [
            {
              // screens greater than >= 775px
              breakpoint: 545,
              settings: {
                // Set to `auto` and provide item width to adjust to viewport
                slidesToShow: '3',
                slidesToScroll: '3',
                // duration: 0.25
              }
            },{
              // screens greater than >= 1024px
              breakpoint: 1024,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 4,
                // itemWidth: 150,
                // duration: 0.25
              }
            }
          ]
    });
});

window.addEventListener('load', function(){
  new Glider(document.querySelector('.carousel__list2'), {
      slidesToShow : 1,
      slidesToScroll : 1,
      // draggable: false,
      dots: '.carousel__indicadores2',
      arrows: {
          prev : '.carousel__prev2',
          next: '.carousel__next2'
      }
  });
});
//this month chart
google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      async function drawChart() {
        const http = await fetch('http://localhost/journey-app/home/getThisMonthJourneyJSONforGoogleChart')
        .then(json => json.json())
        .then(res => res);
        let expenses = [...http];
        expenses.shift();

        let colors = [...http][0];
        colors.shift();
        

        var data = google.visualization.arrayToDataTable(expenses);

        var options = {
          colors: colors
        };

        var chart = new google.charts.Bar(document.getElementById('carousel__elementThisMonth'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

      const url1 = 'http://localhost/journey-app/home/getThisMonthJourneyJSONforGoogleChart';
      const htmlelement1 = 'carousel__elementThisMonth'
      const url2 = 'http://localhost/journey-app/home/getLastMonthJourneyJSONforGoogleChart';
      const htmlelement2 = 'carousel__elementLastMonth';

      google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawThisMonthChart);
        google.charts.setOnLoadCallback(drawLastMonthChart);

      async function drawThisMonthChart() {
        const http = await fetch(url1)
        .then(json => json.json())
        .then(res => res);
        let expenses = [...http];
        expenses.shift();

        let colors = [...http][0];
        colors.shift();
        

        var data = google.visualization.arrayToDataTable(expenses);

        var options = {
          colors: colors
        };

        var chart = new google.charts.Bar(document.getElementById(htmlelement1));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

      async function drawLastMonthChart() {
        const http = await fetch(url2)
        .then(json => json.json())
        .then(res => res);
        let expenses = [...http];
        expenses.shift();

        let colors = [...http][0];
        colors.shift();
        

        var data = google.visualization.arrayToDataTable(expenses);

        var options = {
          colors: colors
        };

        var chart = new google.charts.Bar(document.getElementById(htmlelement2));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }

      
