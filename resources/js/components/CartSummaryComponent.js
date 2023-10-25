import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom';
import LoadingOverlay from "react-loading-overlay-ts";
import { CircularProgress, ListItemIcon } from '@mui/material'
import TextField from '@mui/material/TextField';
import IconButton from '@mui/material/IconButton';
import SyncOutlinedIcon from '@mui/icons-material/SyncOutlined';
import EditOutlinedIcon from '@mui/icons-material/EditOutlined';
import Avatar from "@material-ui/core/Avatar";
import List from "@material-ui/core/List";
import ListItem from "@material-ui/core/ListItem";
import ListItemText from "@material-ui/core/ListItemText";
import DialogTitle from "@material-ui/core/DialogTitle";
import Dialog from "@material-ui/core/Dialog";
import DialogActions from '@mui/material/DialogActions';
import DialogContent from '@mui/material/DialogContent';
import DialogContentText from '@mui/material/DialogContentText';
import Button from '@mui/material/Button';
import Swal from 'sweetalert2'

function CartSummaryComponent(props) {


    const [loading, setLoading] = useState(false)
    const [mounted, setMounted] = useState(false)
    const [data, setData] = useState([])
    const [sub, setSub] = useState(0)
    const [total, setTotal] = useState(0)
    const [totaliva, setTotalIVA] = useState(0)
    const [products, setProducts] = useState([])


    const fetchData = async (id) => {
        setLoading(true);

        await axios
            .get( route('getCartProducts') )
            .then(res => {
                let result = res.data;
                setProducts(result.products)
                setSub(result.subtotal)
                setTotal(result.total)
                setTotalIVA(result.total_iva)

            })
            .catch(error => {
                //console.log("error");
                //console.log(error.response);
                toastr.error(error.response.data.message);
            })
            .finally(() => {
                setLoading(false);
                setMounted(true)

            });
    };

    useEffect(() => {
        fetchData()
    }, [])

    const goToFavorites = (rowIDProduct) => {
        //let routeToGo = route('favoritos.swichtf', rowIDProduct)
        let routeToGo = route('register')
        window.open( routeToGo, "_self");
    }

    function showUnauthenticatedDialog(rowIDProduct){
       return Swal.fire({
            title: '¿Te gustó este producto?',
            text: 'Guárdalo en tus favoritos creando una cuenta. ¡Es fácil y rápido!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0076bd',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Sí, crear mi cuenta ahora.',
            cancelButtonText:'No, en otro momento.'

         }).then((result) => {
            if(result.value){
             console.log('go to favorites')
             goToFavorites(rowIDProduct)
           }
         })
    }

    const formatPrice = (price) => {
        return price.toFixed(2)
    }

    const [newQTY, setNewQTY] = useState(0);
    const [open, setOpen] = useState(false);

    const handleClickOpen = () => {
      setOpen(true);
    };

    const handleClose = (value) => {
      setOpen(false);
    };

    const [num, setNum] = useState(1);
    const [itemToUpdate, setItemToUpdate] = useState('');
    const [productIDToUpdate, setProductIDToUpdate] = useState('');

    const updateProductQty = (id, product_id) => {
        setItemToUpdate(id)
        setProductIDToUpdate(product_id)
        setOpen(true);
      };

      const handleChange = (e) => {
        setNum(e.target.value);
      };





      const deleteItemFromCart = (rowId)  => {

        Swal.fire({
            title: '¿Deseas eliminar este producto del carrito?',
            text: 'Puedes guardarlo en tus favoritos para comprarlo después.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0076bd',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Sí, eliminar del carrito.',
            cancelButtonText:'No, conservar mi producto.'

         }).then((result) => {
            if(result.value){

                setLoading(true);

                axios
                    .post(route('deleteItemFromCart'),{
                        id:rowId
                    })
                    .then(res => {
                        let result = res.data;
                        toastr.success(res.data.message);

                    })
                    .catch(error => {
                        //console.log("error");
                        //console.log(error.response);
                        toastr.error(error.response.data.message);
                    })
                    .finally(() => {
                        setLoading(false);
                        fetchData()
                    });

           }
         })



  };


      const addProductToFavorite = (slug, rowIDProduct)  => {
            setLoading(true);

            axios
                .get(route('addProductToFavorite',slug))
                .then(res => {
                    let result = res.data;
                    toastr.success(res.data.message);

                })
                .catch(error => {
                    //console.log("error");
                    console.log(error.response.status);
                    let status = error.response.status
                    if(status === 401){
                        showUnauthenticatedDialog(rowIDProduct)
                        //usuario  no autenticado preguntar
                    }else{
//console.log(error.response);
toastr.error(error.response.data.message);
                    }

                })
                .finally(() => {
                    setLoading(false);
                });

      };

      const updateQty = (e)  => {

        console.log('itemToUpdate ' + itemToUpdate)

            setLoading(true);

            axios
                .post(route('updateCartQuantity'),{
                    id: itemToUpdate,
                    qty : num,
                    product_id : productIDToUpdate
                })
                .then(res => {
                    let result = res.data;
                    toastr.success(res.data.message);
                    setOpen(false)
                    fetchData()

                })
                .catch(error => {
                    //console.log("error");
                    //console.log(error.response);
                    toastr.error(error.response.data.message);
                })
                .finally(() => {
                    setLoading(false);
                });

      };
      const formatPriceJS = (price) => {
        console.log('price')
        console.log(price)
        return price.toLocaleString('en-US', {
            style: 'currency',
            currency: 'USD',
            maximumFractionDigits: 0
          });
      }


    return (
        <>
            <LoadingOverlay
                active={loading}
                styles={{
                    overlay: base => ({
                        ...base,
                        background: "rgba(255, 255, 255, 0.5)"
                    })
                }}
                spinner={<CircularProgress />}
            >
                {products && products.length>0 ?
                <section className="tables">
                    <div className="container">
                        <div className="row">

                            <div className="col-lg-12">

                                <div className="big-title mayus mb-3 border-bottom-custom">carrito <b>de compras</b> </div>

                                <div className="card-body mb-3">
                                    <div className="table-responsive pb-2">
                                        <table id="myTable" className="table table-striped table-borderless mb-0 ">
                                            <thead className="borders">
                                                <tr className="text-center">
                                                    <th className="body-text mayus bold black"></th>
                                                    <th className="body-text mayus bold black">Producto</th>
                                                    <th className="body-text mayus bold black">Disponibilidad</th>
                                                    <th className="body-text mayus bold black">Precio unitario</th>
                                                    <th className="body-text mayus bold black">iva (%)</th>
                                                    <th className="body-text mayus bold black">cantidad</th>
                                                    <th className="body-text mayus bold black">total</th>
                                                    <th className="body-text mayus bold transparent">edit</th>
                                                    <th className="body-text mayus bold transparent">edit</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                {products && products.map(product => {
                                                    return <tr key={product.rowId}>
                                                        <td className="text-center">
                                                            <a href={route('product.show', product.id)}>
                                                                <img width="180" className="" src={product.image} alt=""></img>
                                                            </a>

                                                        </td>
                                                        <td className="text-center" >
                                                            <a href={route('product.show', product.id)}>

                                                                <p className="mb-0">{product.name}</p>
                                                            </a>
                                                            <p className="mb-0">{product.brand} </p>
                                                        </td>
                                                        <td className="text-center"><i className="fas fa-check fa-2x lightgreen"></i></td>
                                                        <td className="text-center bold black">{formatPriceJS(product.price)}
                                                            {/*{formatPrice(parseInt(precioNew(product.id)) / (product.options.iva / 100 + 1))}*/}
                                                        </td>
                                                        <td className="text-center">
                                                        {product.iva + ' %'}
                                                        </td>


                                                        <td className="text-center pointer">

                                                        <div className="input-group ">
                                                            <div className='d-flex text-center justify-content-center my-auto align-items-center'>
                                                        <span className='mr-2'>{product.qty}</span>


<IconButton aria-label="delete" size="large" onClick={() => updateProductQty(product.rowId, product.id) }>
        <EditOutlinedIcon />
      </IconButton>
      </div>
</div>
{/*}

                                                            <div className="qty-box">

                                                                <input type='button' value='-' className='qtyminus' field='quantity'
                                                                    data-id="{{$product->rowId}}" />
                                                                <input type='number' onkeyup="this.value=this.value.replace(/[^1-9]/g,'');" name='quantity' id="{{$product->rowId}}" value='{{$product->qty}}' className='qty' data-id="{{$product->rowId}}" />

                                                                <input type='button' value='+' className='qtyplus' field='quantity'
                                                                    data-id="{{$product->rowId}}" />
                                                            </div>
                                                            */}
</td>
                                                        <td className="text-center bold black">
                                                        {formatPriceJS(product.total)}
                                                            {/*{formatPrice(intval((precioNew(product.id) * product.qty)))}*/}
                                                        </td>
                                                        <td className="text-center">


                                                                <button type="button"
                                                                className="icons btn-transparent"
                                                                data-toggle="tooltip" data-placement="top" title="Agregar a favoritos"
                                                                onClick={() => addProductToFavorite(product.id,product.rowId )}>
                                                                    <img src={props.heart} className="img-fluid cart-icon-new"></img>
                                                                </button>



                                                        </td>
                                                        <td className="text-center">

                                                                <button type="submit" className="icons btn-transparent"
                                                                 onClick={() => deleteItemFromCart(product.rowId)}

                                                                >
                                                                    <img src={props.trash} className="img-fluid cart-icon-new"></img>
                                                                </button>

                                                        </td>
                                                    </tr>
                                                })}


                                            </tbody>

                                        </table>


                                    </div>
                                </div>


                            </div>

                            <div className="container text-right borders">


                                <div className="row justify-content-end pt-2 pb-2">
                                    <div className="col-6 col-sm-2">
                                    <span className="bold">Sub Total</span>
                                    </div>
                                    <div className="col-6 col-sm-2">
                                        <span className="ml-5 bold">{formatPriceJS(sub)}</span>
                                    </div>
                                </div>


                                <div className="row justify-content-end pt-2 pb-2">
                                    <div className="col-6 col-sm-2">
                                    <span className="bold">IVA</span>
                                    </div>
                                    <div className="col-6 col-sm-2">
                                        <span className="ml-5 bold">{formatPriceJS(totaliva)}</span>

                                    </div>
                                </div>



                                <div className="row justify-content-end pt-2 pb-2">
                                    <div className="col-6 col-sm-2">
                                        <span className="bold">Total</span>
                                    </div>
                                    <div className="col-6 col-sm-2">
                                        <span className="ml-5 bold">{formatPriceJS(total)}</span>

                                    </div>
                                </div>

                            </div>

                            <div className="container">

                                <div className="d-flex justify-content-end pt-4 pb-2">

                                    <a href={route('home')} className="btn btn-primary checkout-button continue-button mr-3">
                                        Seguir comprando</a>


                                    <a href={ route('checkout') } className="btn btn-danger checkout-button mr-3">
                                        <img src={props.cart} className="img-fluid header-icon"></img>
                                        Ir a Pagar $ </a>


                                    {/*<a href={ route('pedido') } className="btn btn-info checkout-button">
                                        <img src={props.cart} className="img-fluid header-icon"></img>
                                        Crear un pedido y pagar después</a>
                                        */}

                                </div>
                            </div>

                        </div>
                    </div>
                </section>
:
<section className="p-5">
  <div className="container p-5">
    <div className="row text-center">
      <div className="col-lg-12">
        {mounted === true ?
        <div className="big-title mayus mb-3 ">carrito <b>de compras vacío</b> </div>
                :null}
      </div>
    </div>
  </div>
</section>
}
                {/*
            @else
            <section className="p-5">
                <div className="container p-5">
                    <div className="row text-center">
                        <div className="col-lg-12">
                            <div className="big-title mayus mb-3 ">carrito <b>de compras vacío</b> </div>
                        </div>
                    </div>
                </div>
            </section>
            @endif
            */}

<Dialog onClose={handleClose} aria-labelledby="title" open={open}>
      <DialogTitle id="title">Nueva cantidad</DialogTitle>
      <DialogContent>
      <List>
          <ListItem
            button
            //onClick={() => handleListItemClick(email)}
          >

    <TextField
          label="Cantidad"
          type="number"
          value={num}
          onChange={handleChange}
          InputLabelProps={{
            shrink: true,
          }}
        />
          </ListItem>

      </List>
      </DialogContent>
      <DialogActions>
          <Button onClick={handleClose}>Cancelar</Button>
          <Button onClick={() => updateQty() }>Actualizar</Button>
        </DialogActions>


    </Dialog>


            </LoadingOverlay>
        </>
    )
}

export default CartSummaryComponent;

if (document.getElementById("cart-summary-component")) {
    const element = document.getElementById("cart-summary-component");
    const props = Object.assign({}, element.dataset);
    ReactDOM.render(<CartSummaryComponent {...props} />, element);
}
