import React from 'react';
import ReactDOM from 'react-dom';
import Radio from '@mui/material/Radio';
import RadioGroup from '@mui/material/RadioGroup';
import FormControlLabel from '@mui/material/FormControlLabel';
import FormControl from '@mui/material/FormControl';
import FormLabel from '@mui/material/FormLabel';


function CheckoutComponent() {
    
    return (
        <div >
    <FormControl component="fieldset">
      <FormLabel component="legend">Selecciona la opción de envío:</FormLabel>
      <RadioGroup
        aria-label="gender"
        defaultValue="female"
        name="radio-buttons-group"
      >
        <FormControlLabel value="cargo_tienda" control={<Radio />} label="Envío a cargo de la tienda" />
        <FormControlLabel value="cargo_cliente" control={<Radio />} label="Envío a cargo del cliente" />
        <FormControlLabel value="recoger_tienda" control={<Radio />} label="Recoger en tienda" />
        
      </RadioGroup>
    </FormControl>
        </div>
    );
}

export default CheckoutComponent;

if (document.getElementById("checkout-component")) {
    const element = document.getElementById("checkout-component");
    const props = Object.assign({}, element.dataset);
    ReactDOM.render(<CheckoutComponent {...props} />, element);
}