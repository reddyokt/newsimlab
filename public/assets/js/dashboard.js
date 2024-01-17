// CHART REGIS
const regisData = $(".registrationData").val();
const totalDpd = $(".totalDPD").val();
const dpdList = $(".dpdList").val();
const valRegisData = Object.values(JSON.parse(regisData));
const valTotalDpd = Object.values(JSON.parse(totalDpd));
const valDpdList = JSON.parse(dpdList);
var roleCode = $('#roleCode').val();
if(roleCode == 'ADM' || roleCode == 'ADPP'){
	var optionsDpd = {
		chart: {
			type: 'bar',
		},
		series: [{
			name: labelDpdList,
			data: valTotalDpd
		}],
		xaxis: {
			categories: valDpdList
		},
		yaxis: {
			labels: {
			formatter: (value) => {
				return value.toFixed(0)
			},
			}
		},
	}
	var chartDpd = new ApexCharts(document.querySelector("#chartTotalDPD"), optionsDpd);
	chartDpd.render();
}

var options = {
    chart: {
        type: 'bar',
    },
    series: [{
        name: labelRegis,
        data: valRegisData
    }],
    xaxis: {
        categories: ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]
    },
	yaxis: {
		labels: {
		  formatter: (value) => {
			return value.toFixed(0)
		  },
		}
	},
}
var chart = new ApexCharts(document.querySelector("#chart"), options);
chart.render();

// CHART GENDER
const genderData = $(".genderData").val();
const valGenderData = Object.values(JSON.parse(genderData));
var optionsPie = {
	series: valGenderData,
	chart: {
		width: 380,
		type: 'pie',
	},
  	labels: [labelMale, labelFemale],
  	responsive: [{
    	breakpoint: 480,
    	options: {
     	 	chart: {
        		width: 200
      		},
      		legend: {
        		position: 'bottom'
      		}
    	}
  	}],
};
var chartPie = new ApexCharts(document.querySelector("#chartPie"), optionsPie);
chartPie.render();

// CHART topFiveDPD
const topFiveDPD = $(".topFiveDPD").val();
const labelTopFiveDPD = Object.keys(JSON.parse(topFiveDPD));
const valTopFiveDPD = Object.values(JSON.parse(topFiveDPD));

var optionsDPD = {
	colors: [ // this array contains different color code for each data
        "#33b2df",
        "#546E7A",
        "#d4526e",
        "#13d8aa",
        "#A5978B"
    ],
	series: [{
		name: labelTotal,
		data: valTopFiveDPD,
		color: "#41B883",
	}],
	chart: {
		type: 'bar',
		height: 350
	},
	plotOptions: {
		bar: {
			distributed: true, // this line is mandatory
			borderRadius: 4,
			horizontal: true,
		}
	},
	dataLabels: {
		enabled: false
	},
	xaxis: {
		categories: labelTopFiveDPD,
		labels: {
		  formatter: (value) => {
			return value.toFixed(0)
		  },
		}
	},
	yaxis: {
		labels: {
		  formatter: (value) => {
			return value
		  },
		}
	},
};
var chartDPD = new ApexCharts(document.querySelector("#chartDPD"), optionsDPD);
chartDPD.render();

// CHART topFiveDPC
const topFiveDPC = $(".topFiveDPC").val();
const labelTopFiveDPC = Object.keys(JSON.parse(topFiveDPC));
const valTopFiveDPC = Object.values(JSON.parse(topFiveDPC));

var optionsDPC = {
	colors: ['#2b908f', '#f9a3a4', '#90ee7e','#f48024', '#69d2e7'],
		series: [{
		name: labelTotal,
		data: valTopFiveDPC
	}],
		chart: {
		type: 'bar',
		height: 350
	},
	plotOptions: {
		bar: {
			distributed: true, // this line is mandatory
			borderRadius: 4,
			horizontal: true,
		}
	},
	dataLabels: {
		enabled: false
	},
	xaxis: {
		categories: labelTopFiveDPC,
		labels: {
		  formatter: (value) => {
			return value.toFixed(0)
		  },
		}
	},
	yaxis: {
		labels: {
		  formatter: (value) => {
			return value
		  },
		}
	},
};
var chartDPC = new ApexCharts(document.querySelector("#chartDPC"), optionsDPC);
chartDPC.render();

$(document).on('change', '.filterType', function(){
	var val = $(this).val();

	// $("#chartPie").empty();
	var optionsPie = null;
	if(val == 'gender'){
		$('#titleGrafikType').html(titleGrafikGender);

		const genderData = $(".genderData").val();
		const valGenderData = Object.values(JSON.parse(genderData));
		optionsPie = {
			series: valGenderData,
			chart: {
				width: 380,
				type: 'pie',
			},
			labels: [labelMale, labelFemale],
			responsive: [{
				breakpoint: 480,
				options: {
					chart: {
						width: 200
					},
					legend: {
						position: 'bottom'
					}
				}
			}],
		};
	}else{
		$('#titleGrafikType').html(titleGrafikEducation);

		const educationData = $(".educationData").val();
		const valEducationData = Object.values(JSON.parse(educationData));
		var optionsPie = {
			series: valEducationData,
			chart: {
				width: 380,
				type: 'pie',
			},
			labels: [labelDiploma, labelSarjana, labelMaster, labelDoktoral],
			responsive: [{
				breakpoint: 480,
				options: {
					chart: {
						width: 200
					},
					legend: {
						position: 'bottom'
					}
				}
			}],
		};
	}
	chartPie.updateOptions(optionsPie);
	// chartPie.render();
});