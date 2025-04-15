const host = "https://vertuka.com/";
const mapApiKey = "web.895f4f6a170b40db80563ecf2b4e151a";
const doteApiKey = "service.a47b2bcabc554c96a37c9839dbd29931";

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
//const poi = false;

//const traffic= true;
const traffic = false;

const mapZoom = 15;

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
  mapKey: mapApiKey,
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
  mapKey: mapApiKey,
  poi: poi,
  traffic: traffic,
  mapTypeControllerStatus: {
    show: false,
    position: "bottom-right",
  },
});

// get user location on map
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

// add marker to the map
const marker = new nmp_mapboxgl.Marker({
  color: "#FF5733",
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

  // MD - Seprate the latandlng - START
  const match = lngLat.toString().match(/LngLat\((.*?), (.*?)\)/);
  const longitude = parseFloat(match[1]);
  const latitude = parseFloat(match[2]);
  // MD - Pass the element to get location information
  getNeshanReverseGeocode(latitude, longitude, doteApiKey);
  const addrCotainer = document.getElementById("addresspress-save-new-address");

  addrCotainer.classList.remove("d-none");
  addrCotainer.scrollIntoView({
    behavior: "smooth",
  });
  setTimeout(() => {
    addrCotainer.classList.remove("dimmed");
  }, 200);

  // MD - Go to write the contiue of neshani posti
  const textarea = document.getElementById("addresspress-address1");
  textarea.focus();
  textarea.selectionStart = textarea.selectionEnd = textarea.value.length;
}

function addresspress_set_coordinatesEdit() {
  const lngLat = markerEdit.getLngLat();
  document.getElementById("coordinatesEdit").value = lngLat;
  document
    .getElementById("addresspress-edit-address")
    .classList.remove("d-none");
  document.querySelector("#addresspress-edit-address").scrollIntoView({
    behavior: "smooth",
  });
}

const mapApiKey_SERVICE = "service.058e6c03a4844bb5b4fa6f9f75d82658";
function mj_get_address_by_longitude_latitude(Latitude, Longitude) {
  fetch(
    "https://api.neshan.org/v5/reverse?lat=" + Latitude + "&lng=" + Longitude,
    {
      headers: {
        Accept: "application/json",
        "Api-Key": mapApiKey_SERVICE,
      },
    }
  )
    .then((response) => response.json())
    .then((data) => {
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
        "Api-Key": mapApiKey_SERVICE,
      },
    }
  )
    .then((response) => response.json())
    .then((data) => {
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
              makeDiveResualt(result_data.items[i], i);
            }
          }
        )
        .done(function () {})
        .fail(function () {})
        .always(function () {});
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
              makeDiveResualtEdit(result_data.items[i], i);
            }
          }
        )
        .done(function () {})
        .fail(function () {})
        .always(function () {});
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

//
function getNeshanReverseGeocode(latitude, longitude, doteApiKey) {
  const url = `https://api.neshan.org/v5/reverse?lat=${latitude}&lng=${longitude}`;
  fetch(url, {
    method: "GET",
    headers: {
      "Api-Key": doteApiKey,
    },
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok " + response.statusText);
      }
      return response.json();
    })
    .then((data) => {
      let status = data.status;
      let city = data.city;
      let state = data.state;
      state = state.replace("استان ", "");
      let formatted_address = data.formatted_address;

      // MD - Perform for State
      const selectState = document.getElementById("addresspress-state");

      // حذف انتخاب قبلی (اگه وجود داشته باشه)
      Array.from(selectState.options).forEach((option) => {
        option.selected = false;
      });

      // پیدا کردن گزینه مورد نظر و انتخابش
      const optionToSelect = Array.from(selectState.options).find(
        (option) => option.text === state
      );
      if (optionToSelect) {
        optionToSelect.selected = true;

        // اختیاری: باعث میشه بصورت ظاهری هم آپدیت بشه
        selectState.dispatchEvent(new Event("change"));
      }

      var $el = jQuery(".add-address-lightbox #addresspress-city");
      $el.empty();
      $el.append(gform_iranCities(state));

      const selectElement = document.getElementById("addresspress-city");

      const optionToSelectC = Array.from(selectElement.options).find(
        (option) => option.text === city
      );

      if (optionToSelectC) {
        optionToSelectC.selected = true;
      } else {
        console.error(`گزینه با نام "${city}" پیدا نشد.`);
      }

      // MD - Perform for Full Address
      const selectAddr = document.getElementById("addresspress-address1");
      if (selectAddr) {
        selectAddr.value = formatted_address;
      }
    })
    .catch((error) => {
      console.error("There was a problem with the fetch operation:", error);
    });
}
