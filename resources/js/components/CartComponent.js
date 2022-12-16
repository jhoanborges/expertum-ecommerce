import React, { useState, useEffect,useMemo  } from 'react';
import ReactDOM from "react-dom";
import { makeStyles } from '@material-ui/core/styles';
import Drawer from '@material-ui/core/Drawer';
import Button from '@material-ui/core/Button';
import List from '@material-ui/core/List';
import Divider from '@material-ui/core/Divider';
import ListItem from '@material-ui/core/ListItem';
import ListItemIcon from '@material-ui/core/ListItemIcon';
import ListItemText from '@material-ui/core/ListItemText';
import ShoppingCartOutlinedIcon from '@material-ui/icons/ShoppingCartOutlined';
import Fab from '@material-ui/core/Fab';
import axios from 'axios'
import PaymentOutlinedIcon from '@material-ui/icons/PaymentOutlined';
import LoadingOverlay from 'react-loading-overlay-ts';
import ClipLoader from 'react-spinners/ClipLoader'
import RemoveShoppingCartOutlinedIcon from '@material-ui/icons/RemoveShoppingCartOutlined';
import HighlightOffOutlinedIcon from '@material-ui/icons/HighlightOffOutlined';

const MAX_WIDTH = 250;

const useStyles = makeStyles({
  fab: {
    zIndex: 999,
    position: "fixed !important",
    bottom: "9rem",
    right: "0.7rem"
  },
  list: {
    width: MAX_WIDTH,
  },
  fullList: {
    width: 'auto',
  },
  paymentbutton: {
    textAlign: "center",
    paddingBottom: 10,
  },
  paymentWrapper: {
    marginTop: 'auto'
    /*position: "fixed",
    bottom: 0*/
  }
});

function CartComponent(props) {
  const classes = useStyles();

  const [data, setData] = useState([])
  const [loading, setLoading] = useState(true)



  const getCart = () => {
    setLoading(true);

    axios
      .get(route("getCart"))
      .then(res => {
        setData(res.data);
      })
      .catch(error => {
        setLoading(false);
      })
      .finally(() => {
        setLoading(false);
      });
  };

  useEffect(() => {
    const timer = setTimeout(() => {
      console.log('This will run after 1 second!')
    }, 1000);
    return () => clearTimeout(timer);
  }, []);

  const [open, setOpen] = React.useState(false);

  const handleDrawerOpen = () => {
    getCart();
    setOpen(true);

  };

  const handleDrawerClose = () => {
    setOpen(false);
  };

  //use effect no funciona :S



  const formatNumber = (num) => {
    return num.toLocaleString("de-DE", { maximumFractionDigits: 0, minimumFractionDigits: 0 });
  }


  const openProduct = (item) => {
    window.location.href = route('product.show', { 'slug': item.id })
  }
  const gotToCheckout = () => {
    window.location.href = route('checkout')
  }
  

  const removeItem = (item) => {
    setLoading(true);

    axios
      .post(route("removeProductFromCart") , {
        id:item.rowId
      })
      .then(res => {
        getCart()
      })
      .catch(error => {
        setLoading(false);
      })
      .finally(() => {
        setLoading(false);
      });
  };


  
  
  const _renderList = () => (
    <div
      role="presentation"
      onClick={handleDrawerOpen}
      onKeyDown={handleDrawerClose}
    >

<LoadingOverlay
      active={loading}
      styles={{
        overlay: base => ({
            ...base,
            background: "rgba(255, 255, 255)"
        })
    }}
      spinner={<ClipLoader size={50} color={"#f50057"} />}
    >
      
          <List>
            {data.length > 0 ? 
            <div>
            {data.map((item, index) => (
              <div  key={item.rowId} className="d-flex">
              <ListItem button key={item.rowId}
                onClick={() => openProduct(item)}
              >
                <ListItemIcon>
                  <img width="50" src={item.options ? item.options.imagen : null}></img>
                </ListItemIcon>
                <ListItemText primary={item.name} secondary={item.qty + ' x ' + formatNumber(item.price)} />
              </ListItem>
                      <ListItemIcon style={{minWidth : 10 , marginLeft:10,
                       display: 'flex' ,
                       alignItems :'center',
                       cursor:'pointer'
                       }}  onClick={() => removeItem(item)}>
                      <HighlightOffOutlinedIcon/>
                      </ListItemIcon>
                      </div>
            ))}
            </div>
            : 
            
            <ListItem>
              <ListItemIcon>
              <img width="50" src={props.productimage ? props.productimage : 
              <RemoveShoppingCartOutlinedIcon/>
              }></img>

              </ListItemIcon>
            <ListItemText primary='Carrito de compras vacio' secondary='Selecciona un producto y haz click en el botón comprar' />

          </ListItem>}
          

          </List>
          <Divider />
  
          <List  style={{ paddingTop:0,paddingBottom:0 }}>
    <ListItem  style={{ paddingTop:0,paddingBottom:0 }}>
    <ListItemText primary={'Total'} secondary={formatNumber( parseFloat(props.total))} style={{ textAlign: 'right' }} >
      </ListItemText>
    </ListItem>
  </List>


        <List  style={{ paddingTop:0,paddingBottom:0 }}>
    <ListItem onClick={() => gotToCheckout()} style={{ paddingTop:0,paddingBottom:0 }}  >
      <ListItemText>
      <Button
className="mt-auto"
  fullWidth
  startIcon={<PaymentOutlinedIcon />}
  className={classes.paymentbutton} variant="contained" color="secondary">
  Pagar
</Button>
      </ListItemText>
    </ListItem>
  </List>




  </LoadingOverlay>

    </div>
  );


  return (
    <div>

      <Fab color="primary" aria-label="add" className={classes.fab} onClick={handleDrawerOpen}>
        <ShoppingCartOutlinedIcon />
      </Fab>


      <React.Fragment>
        <Drawer anchor={'right'} open={open} onClose={handleDrawerClose}>
          {_renderList()}
        </Drawer>
      </React.Fragment>

    </div>
  );
}


export default CartComponent;

if (document.getElementById("cart-component")) {
  const element = document.getElementById("cart-component");
  const props = Object.assign({}, element.dataset);
  ReactDOM.render(<CartComponent {...props} />, element);
}