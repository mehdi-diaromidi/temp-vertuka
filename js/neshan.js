const host = "https://vertuka.com/";
//API_KEY
/* با مراجعه به پنل کاربری خود می توانید کلید دسترسی لازم برای نمایش نقشه را ایجاد نمائید
 * توجه فرمائید کلید دسترسی ای که در پنل خود برای نمایش نقشه ایجاد میکنید حتما از نوع نمایش نقشه وب باشد
 *
 * https://platform.neshan.org/panel/api-key
 *
 *  */
const API_KEY = "web.895f4f6a170b40db80563ecf2b4e151a";

if (
  document.getElementById("neshanMapContainer") ||
  document.getElementById("neshanMapContainerEdit")
) {
}
// get map dom element
const mapContainer = document.getElementById("neshanMapContainer");
const mapContainerEdit = document.getElementById("neshanMapContainerEdit");

// map properties
/* حداقل اندازه نقشه با تغییر دو عبارت زیر می توانید حداقل طول و عرض نمایش نقشه را عوض کنید */
const neshanMapWidth = "350px";
const neshanMapHeight = "300px";

mapContainer.style.minHeight = neshanMapWidth;
mapContainer.style.minWidth = neshanMapHeight;

mapContainerEdit.style.minHeight = neshanMapWidth;
mapContainerEdit.style.minWidth = neshanMapHeight;

/* رنگ آیکون مرکز نقشه */
const neshanMarkerColor = "#FF8330";

/* موقعیت مرکز نقشه برای نمایش به کاربر و افزودن آیکون بر روی آن
 *
 * برای بدست آوردن مختصات مورد نظر خود می توانید به نقشه وب نشان مراجعه کنید با کلیک راست کردن بر روی محل مورد نظرتان گزینه "کپی مختصات این نقطه" انتخاب کنید
 * تا برای شما مختصات در حافظه کپی شود و سپس مقادیر کپی شده را در قسمت زیر الصاق کنید
 *
 * https://neshan.org/maps
 *
 * */
const mapCenterLocation = [35.699789639952414, 51.33748508581425]; //latitude,longitude
const mapCenterLocationEdit = [35.699789639952414, 51.33748508581425]; //latitude,longitude

// show poi and traffic on map
/* در صورتی که میخواید بر روی نقشه خود اطلاعات ترافیکی به همراه مکان های مختلف مثل مغازه ها، مجتمع ها، فروشگاه ها، بیمارستان ها و ... نیز نمایش داده شوند کافیست مقادیر را مانند زیر تغییر نمائید */

//نمایش مکان های منتخب:
const poi = true;
//عدم نمایش مکان های منتخب:
//const poi = false;

//نمایش ترافیک
//const traffic= true;
//عدم نمایش ترافیک
const traffic = false;

/* میزان زوم نقشه بر روی محل مرکز نقشه هر چقدر این مقدار بزرگ تر باشد به معنی این است که به سطح زمین نزدیکتر هستیم و محدوده کوچکتری را مشاهده میکنیم در نقشه */
const mapZoom = 15;

/* نوع نقشه در صورتی که می خواهید نقشه شما ظاهر دیگری داشته باشد می توانید این مقدار را عوض نمائید ، برای تغییر نوع نقشه چهار حالت در نظر گرفته شده است */
const mapType = nmp_mapboxgl.Map.mapTypes.neshanVector; //نقشه با کاشی های برداری روز
//const mapType = nmp_mapboxgl.Map.mapTypes.neshanVectorNight;  // نقشه با کاشی های برداری شب
//const mapType = nmp_mapboxgl.Map.mapTypes.neshanRaster; // نقشه با کاشی های پیکسلی
//const mapType = nmp_mapboxgl.Map.mapTypes.neshanRasterNight; // نقشه با کاشی های پیکسلی در شب

// Create map object
const map = new nmp_mapboxgl.Map({
  mapType: mapType,
  container: mapContainer,
  zoom: mapZoom,
  pitch: 0,
  center: mapCenterLocation.reverse(),
  minZoom: 2,
  maxZoom: 21,
  trackResize: true,
  mapKey: API_KEY,
  poi: poi,
  traffic: traffic,
  mapTypeControllerStatus: {
    show: false,
    position: "bottom-right",
  },
});

const mapEdit = new nmp_mapboxgl.Map({
  mapType: mapType,
  container: mapContainerEdit,
  zoom: mapZoom,
  pitch: 0,
  center: mapCenterLocationEdit.reverse(),
  minZoom: 2,
  maxZoom: 21,
  trackResize: true,
  mapKey: API_KEY,
  poi: poi,
  traffic: traffic,
  mapTypeControllerStatus: {
    show: false,
    position: "bottom-right",
  },
});

// get user location on map
/* در صورتی که نیازی ندارید که موقعیت کاربر را دریافت کنید میتوانید کد های این قسمت را پاک نماید */
map.addControl(
  new nmp_mapboxgl.GeolocateControl({
    positionOptions: { enableHighAccuracy: true },
    trackUserLocation: false,
    showUserHeading: false,
  })
);
mapEdit.addControl(
  new nmp_mapboxgl.GeolocateControl({
    positionOptions: { enableHighAccuracy: true },
    trackUserLocation: false,
    showUserHeading: false,
  })
);
/* پایان قسمت کد های گرفتن موقعیت کاربر  */

// add marker to the map
/* در صورتی که نیازی به افزودن مارکر بر روی نقشه خود ندارید می توانید کد های این قسمت را پاک نمائید  */
const marker = new nmp_mapboxgl.Marker({
  color: "#FF5733",
  // 		draggable: true,
})
  .setLngLat(mapCenterLocation)
  .addTo(map);
const markerEdit = new nmp_mapboxgl.Marker({
  color: "#FF5733",
  // 		draggable: true,
})
  .setLngLat(mapCenterLocationEdit)
  .addTo(mapEdit);
/* پایان قسمت کد های افزودن مارکر به نقشه  */

map.on("movestart", function (e) {
  marker.setLngLat(map.getCenter());
});

map.on("move", function (e) {
  marker.setLngLat(map.getCenter());
});

map.on("moveend", function (e) {
  marker.setLngLat(map.getCenter());
});

// 		mapEdit.on('render', () => {
// 			map.resize();
// 		});
mapEdit.on("movestart", function (e) {
  markerEdit.setLngLat(mapEdit.getCenter());
});

mapEdit.on("move", function (e) {
  markerEdit.setLngLat(mapEdit.getCenter());
});

mapEdit.on("moveend", function (e) {
  markerEdit.setLngLat(mapEdit.getCenter());
});

// 	MJ
function addresspress_set_coordinates() {
  const lngLat = marker.getLngLat();
  document.getElementById("coordinates").value = lngLat;
  //mj_get_address_by_longitude_latitude(lngLat.lat, lngLat.lng);
  document
    .getElementById("addresspress-save-new-address")
    .classList.remove("d-none");
  document.querySelector("#addresspress-save-new-address").scrollIntoView({
    behavior: "smooth",
  });
}
function addresspress_set_coordinatesEdit() {
  const lngLat = markerEdit.getLngLat();
  document.getElementById("coordinatesEdit").value = lngLat;
  //mj_get_address_by_longitude_latitudeEdit(lngLat.lat, lngLat.lng);
  document
    .getElementById("addresspress-edit-address")
    .classList.remove("d-none");
  document.querySelector("#addresspress-edit-address").scrollIntoView({
    behavior: "smooth",
  });
}

const API_KEY_SERVICE = "service.058e6c03a4844bb5b4fa6f9f75d82658";
function mj_get_address_by_longitude_latitude(Latitude, Longitude) {
  fetch(
    "https://api.neshan.org/v5/reverse?lat=" + Latitude + "&lng=" + Longitude,
    {
      headers: {
        Accept: "application/json",
        "Api-Key": API_KEY_SERVICE,
      },
    }
  )
    .then((response) => response.json())
    .then((data) => {
      // 				console.log(data.formatted_address);
      let address_input = (document.getElementById(
        "addresspress-address1"
      ).value = data.formatted_address);
    });
}
function mj_get_address_by_longitude_latitudeEdit(Latitude, Longitude) {
  fetch(
    "https://api.neshan.org/v5/reverse?lat=" + Latitude + "&lng=" + Longitude,
    {
      headers: {
        Accept: "application/json",
        "Api-Key": API_KEY_SERVICE,
      },
    }
  )
    .then((response) => response.json())
    .then((data) => {
      // 				console.log(data.formatted_address);
      //let address_input = document.getElementById("addresspress-address1-edit").value = data.formatted_address;
      document.getElementById("addresspress-edit-address").elements[
        "addresspress-address1"
      ].value = data.formatted_address;
    });
}

////////////////////////////////////////////////////////////////////////////////////
var searchMarkers = [];
var number_of_addresses_to_show = 5;
jQuery("#neshan-search").on("keyup", function (e) {
  if (e.which !== 32) {
    var value = jQuery(this).val();
    var noWhitespaceValue = value.replace(/\s+/g, "");
    var noWhitespaceCount = noWhitespaceValue.length;
    if (noWhitespaceCount > 2) {
      // Call API
      // restarting the markers
      for (var j = 0; j < searchMarkers.length; j++) {
        if (searchMarkers[j] != null) {
          searchMarkers[j].remove();

          //map.removeLayer(searchMarkers[j]);
          // searchMarkers[j] = null;
        }
      }
      //making url
      var url = `https://api.neshan.org/v1/search?term=${noWhitespaceValue}&lat=${35.699739}&lng=${51.338097}`;
      var jqxhr = jQuery
        .get(
          {
            url: url,
            headers: {
              "Api-Key": "service.f58de21cdcc74c97be8f37af98ae2a4d",
            },
          },
          function (result_data) {
            //nsole.log(result_data);

            //for every search resualt add marker
            var i;
            document.getElementById("neshan-result").innerHTML = "";

            if (result_data.count < 5) {
              number_of_addresses_to_show = result_data.count;
            } else {
              number_of_addresses_to_show = 5;
            }
            for (i = 0; i < number_of_addresses_to_show; i++) {
              var info = result_data.items[i];

              //searchMarkers[i] = new nmp_mapboxgl.Marker({}).setLngLat([info.location.x, info.location.y]).addTo(map);

              makeDiveResualt(result_data.items[i], i);
            }

            //alert( "success" );
          }
        )
        .done(function () {
          //alert( "second success" );
        })
        .fail(function () {
          //alert( "error" );
        })
        .always(function () {
          //alert( "finished" );
        });
    }
  }
});

jQuery("#neshan-search-edit").on("keyup", function (e) {
  if (e.which !== 32) {
    var value = jQuery(this).val();
    var noWhitespaceValue = value.replace(/\s+/g, "");
    var noWhitespaceCount = noWhitespaceValue.length;
    if (noWhitespaceCount > 2) {
      // Call API
      // restarting the markers
      for (var j = 0; j < searchMarkers.length; j++) {
        if (searchMarkers[j] != null) {
          searchMarkers[j].remove();

          //map.removeLayer(searchMarkers[j]);
          // searchMarkers[j] = null;
        }
      }
      //making url
      var url = `https://api.neshan.org/v1/search?term=${noWhitespaceValue}&lat=${35.699739}&lng=${51.338097}`;
      var jqxhr = jQuery
        .get(
          {
            url: url,
            headers: {
              "Api-Key": "service.f58de21cdcc74c97be8f37af98ae2a4d",
            },
          },
          function (result_data) {
            //console.log(result_data);

            //for every search resualt add marker
            var i;
            document.getElementById("neshan-result-edit").innerHTML = "";

            if (result_data.count < 5) {
              number_of_addresses_to_show = result_data.count;
            } else {
              number_of_addresses_to_show = 5;
            }
            for (i = 0; i < number_of_addresses_to_show; i++) {
              var info = result_data.items[i];

              //searchMarkers[i] = new nmp_mapboxgl.Marker({}).setLngLat([info.location.x, info.location.y]).addTo(map);

              makeDiveResualtEdit(result_data.items[i], i);
            }

            //alert( "success" );
          }
        )
        .done(function () {
          //alert( "second success" );
        })
        .fail(function () {
          //alert( "error" );
        })
        .always(function () {
          //alert( "finished" );
        });
    }
  }
});

function makeDiveResualt(data, index) {
  var resultsDiv = document.getElementById("neshan-result");
  var resultDiv = document.createElement("div");
  resultDiv.onclick = function (e) {
    map.setCenter([data.location.x, data.location.y]);
    document.getElementById("neshan-result").innerHTML = "";
  };
  resultDiv.dir = "rtl";
  resultDiv.style =
    "background-color: #EEEEEE;padding: 5px 15px;margin: 10px;border-radius: 15px;";
  var resultAddress = document.createElement("span");
  resultAddress.textContent = `${data.address}`;
  resultAddress.innerHTML += "<br>";
  resultAddress.innerHTML += `${data.title}`;

  resultsDiv.style = `border: 1px solid #DDDDDD;border-radius: 10px;margin-top: 5px;margin-bottom: 5px;`;
  resultsDiv.appendChild(resultDiv);
  resultDiv.appendChild(resultAddress);
}
function makeDiveResualtEdit(data, index) {
  var resultsDiv = document.getElementById("neshan-result-edit");
  var resultDiv = document.createElement("div");
  resultDiv.onclick = function (e) {
    mapEdit.setCenter([data.location.x, data.location.y]);
    document.getElementById("neshan-result-edit").innerHTML = "";
  };
  resultDiv.dir = "rtl";
  resultDiv.style =
    "background-color: #EEEEEE;padding: 5px 15px;margin: 10px;border-radius: 15px;";
  var resultAddress = document.createElement("span");
  resultAddress.textContent = `${data.address}`;
  resultAddress.innerHTML += "<br>";
  resultAddress.innerHTML += `${data.title}`;

  resultsDiv.style = `border: 1px solid #DDDDDD;border-radius: 10px;margin-top: 5px;margin-bottom: 5px;`;
  resultsDiv.appendChild(resultDiv);
  resultDiv.appendChild(resultAddress);
}
