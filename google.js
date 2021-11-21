let autocomplete;
let indirizzo;
let CAP;

function initAutocomplete() {
  indirizzo = document.querySelector("#indirizzo");
  CAP = document.querySelector("#CAP");
  // Create the autocomplete object, restricting the search predictions to
  // addresses in the US and Canada.
  autocomplete = new google.maps.places.Autocomplete(indirizzo, {
    componentRestrictions: { country: ["it"] },
    fields: ["address_components", "geometry"],
    types: ["address"],
  });
  indirizzo.focus();
  autocomplete.addListener("place_changed", fillInAddress);
}

function fillInAddress() {
  const place = autocomplete.getPlace();
  let address = "";
  let postcode = "";

  // Get each component of the address from the place details,
  // and then fill-in the corresponding field on the form.
  // place.address_components are google.maps.GeocoderAddressComponent objects
  // which are documented at http://goo.gle/3l5i5Mr
  for (const component of place.address_components) {
    const componentType = component.types[0];

    switch (componentType) {
      case "street_number": {
        address = `${component.long_name} ${address}`;
        break;
      }

      case "route": {
        address += component.short_name;
        break;
      }

      case "postal_code": {
        postcode = `${component.long_name}${postcode}`;
        break;
      }

      case "postal_code_suffix": {
        postcode = `${postcode}-${component.long_name}`;
        break;
      }
      case "locality":
        document.querySelector("#citta").value = component.long_name;
        break;
      case "administrative_area_level_2": {
        document.querySelector("#provincia").value = component.short_name;
        break;
      }
      case "country":
        document.querySelector("#nazione").value = component.long_name;
        break;
    }
  }

  indirizzo.value = address;
  CAP.value = postcode;
}
