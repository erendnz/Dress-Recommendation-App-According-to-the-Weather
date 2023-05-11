// önümüzdeki 5 gün !!!!!!!
var d = new Date();
var weekday = ["pazar", "pazartesi", "salı", "çarşamba", "perşembe", "cuma", "cumartesi"];

function GetInfo() {
    var newName = document.getElementById("cityInput");
    cityInput.innerHTML = newName.value;

    fetch('https://api.openweathermap.org/data/2.5/forecast?q='+newName.value+'&appid=32ba0bfed592484379e51106cef3f204')
    .then(response => response.json())
    .then(data => {
        //min ve max değerleri çekme
        for (i = 0; i < 5; i++){
            var temp = Number(data.list[i].main.temp - 273.15).toFixed(1);
            document.getElementById("day" + (i + 1) + "temp").innerHTML = temp; //html içerisindeki hidden bir nesneye apiden gelen temp değerini yazıyoruz sonra cinsiyet değiştirdiğimizde bunu alıp kullanacağız
            //Gets Min
            var min = Number(data.list[i].main.temp_min - 273.15).toFixed(1);
            document.getElementById("day" + (i + 1) + "Min").innerHTML = min + "°C /";
            //Gets Max
            var max = Number(data.list[i].main.temp_max - 273.15).toFixed(2);
            document.getElementById("day" + (i + 1) + "Max").innerHTML = max + "°C";
            //Gest icons
            document.getElementById("img" + (i + 1)).src = "icons/" + data.list[i].weather[0].icon + ".png";
            GetClothes(temp, i+1);
        }
        console.log(data);
    })
    // konum düzgün girilmediği zaman verilen error
    .catch(err => alert("Geçerli Bir Konum Giriniz."))
}
function Ankara(){
    document.getElementById("cityInput").defaultValue = "Ankara";
    GetInfo();
}
function Istanbul(){
    document.getElementById("cityInput").defaultValue = "Istanbul";
    GetInfo();
}
function DefaultScreen(){
    document.getElementById("cityInput").defaultValue = "İzmir";
    GetInfo();
}

function CheckDay(day) {
    if(day + d.getDay() > 6){
        return day + d.getDay() - 7;
    }
    else{
        return day + d.getDay();
    }
}

for(i = 0; i<5; i++){
    document.getElementById("day" + (i+1)).innerHTML = weekday[CheckDay(i)];
}
//API den çağırılan
function GetClothes(temp, dayCount) {
    var gender = document.getElementById("chkGender").checked ? "woman" : "man"; //checkliyse kadın değilse erkek
    ChangeClothes(gender, temp, dayCount);
}

function ChangeGender() { 
    var gender = document.getElementById("chkGender").checked ? "woman" : "man";
    for (var i = 1; i < 6; i++) {
        var temp = document.getElementById("day" + i + "temp").innerHTML;//bu nesne hidden
        ChangeClothes(gender,temp,i);
    }   
}

//işi yapan metod
function ChangeClothes(gender, temp, dayCount) {
    var random = randomIntFromInterval(1, 5);   
    if (gender == "woman") {
        if (temp > 15) {
            document.getElementById("img" + dayCount + "Top").src = "clothes/women/womentop/hot/" + random + ".png";
            document.getElementById("img" + dayCount + "Out").src = "clothes/women/womenbottom/hot/" + random + ".png"; 
            document.getElementById("img" + dayCount + "Bottom").src = "clothes/women/womenoutwear/hot/" + random + ".png";
            document.getElementById("img" + dayCount + "Shoe").src = "clothes/women/womenshoes/hot/" + random + ".png";
            document.getElementById("img" + dayCount + "Acc").src = "clothes/women/womenacc/" + random + ".png";
        }
        else {
            document.getElementById("img" + dayCount + "Top").src = "clothes/women/womentop/cold/" + random + ".png";
            document.getElementById("img" + dayCount + "Out").src = "clothes/women/womenbottom/cold/" + random + ".png"; 
            document.getElementById("img" + dayCount + "Bottom").src = "clothes/women/womenoutwear/cold/" + random + ".png";
            document.getElementById("img" + dayCount + "Shoe").src = "clothes/women/womenshoes/cold/" + random + ".png";
            document.getElementById("img" + dayCount + "Acc").src = "clothes/women/womenacc/" + random + ".png";
        }
    }
    else {//mense
        if (temp > 15) {
            document.getElementById("img" + dayCount + "Top").src = "clothes/men/mentop/hot/" + random + ".png";
            document.getElementById("img" + dayCount + "Out").src = "clothes/men/menbottom/hot/" + random + ".png"; 
            document.getElementById("img" + dayCount + "Bottom").src = "clothes/men/menoutwear/hot/" + random + ".png";
            document.getElementById("img" + dayCount + "Shoe").src = "clothes/men/menshoes/hot/" + random + ".png";
            document.getElementById("img" + dayCount + "Acc").src = "clothes/men/menacc/" + random + ".png";
        }
        else {//cold
            document.getElementById("img" + dayCount + "Top").src = "clothes/men/mentop/cold/" + random + ".png";
            document.getElementById("img" + dayCount + "Out").src = "clothes/men/menbottom/cold" + random + ".png"; 
            document.getElementById("img" + dayCount + "Bottom").src = "clothes/men/menoutwear/cold/" + random + ".png";
            document.getElementById("img" + dayCount + "Shoe").src = "clothes/men/womenshoes/cold/" + random + ".png";
            document.getElementById("img" + dayCount + "Acc").src = "clothes/men/menacc/" + random + ".png";

        }
    }
}
// istediğimiz iki değer arasında random sayı üretir
function randomIntFromInterval(min, max) { // min and max included 
    return Math.floor(Math.random() * (max - min) + min)
}