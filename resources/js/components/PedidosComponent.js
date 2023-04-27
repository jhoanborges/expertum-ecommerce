import React, { useState, useEffect } from "react";
import ReactDOM from "react-dom";
import LoadingOverlay from "react-loading-overlay-ts";
import { CircularProgress, ListItemIcon } from "@mui/material";
import Swal from "sweetalert2";
import {
    Col,
    Row,
    Divider,
    RowButton,
    Checkbox,
    Form,
    Input,
    Space,
} from "antd";
import "antd/dist/reset.css";

import { styled } from "@mui/material/styles";
import Paper from "@mui/material/Paper";
import Grid from "@mui/material/Unstable_Grid2";
import Box from "@mui/material/Box";
import TextField from "@mui/material/TextField";

const Item = styled(Paper)(({ theme }) => ({
    // backgroundColor: theme.palette.mode === 'dark' ? '#1A2027' : '#fff',
    //...theme.typography.body2,
    padding: theme.spacing(1),
    // textAlign: 'center',
    color: theme.palette.text.secondary,
}));

const style = {
    padding: "8px 0",
};

function PedidosComponent(props) {
    const [loading, setLoading] = useState(false);
    const [mounted, setMounted] = useState(false);
    const [data, setData] = useState([]);
    const [sub, setSub] = useState(0);
    const [total, setTotal] = useState(0);
    const [totaliva, setTotalIVA] = useState(0);
    const [products, setProducts] = useState([]);

    const fetchData = async (id) => {
        setLoading(true);

        await axios
            .get(route("getCartProducts"))
            .then((res) => {
                let result = res.data;
                setProducts(result.products);
                setSub(result.subtotal);
                setTotal(result.total);
                setTotalIVA(result.total_iva);
            })
            .catch((error) => {
                //console.log("error");
                //console.log(error.response);
                toastr.error(error.response.data.message);
            })
            .finally(() => {
                setLoading(false);
                setMounted(true);
            });
    };

    useEffect(() => {
        fetchData();
    }, []);

    const goToFavorites = (rowIDProduct) => {
        //let routeToGo = route('favoritos.swichtf', rowIDProduct)
        let routeToGo = route("register");
        window.open(routeToGo, "_self");
    };

    function showUnauthenticatedDialog(rowIDProduct) {
        return Swal.fire({
            title: "¿Te gustó este producto?",
            text: "Guárdalo en tus favoritos creando una cuenta. ¡Es fácil y rápido!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#0076bd",
            cancelButtonColor: "#dc3545",
            confirmButtonText: "Sí, crear mi cuenta ahora.",
            cancelButtonText: "No, en otro momento.",
        }).then((result) => {
            if (result.value) {
                console.log("go to favorites");
                goToFavorites(rowIDProduct);
            }
        });
    }

    const formatPrice = (price) => {
        return price.toFixed(2);
    };

    const [newQTY, setNewQTY] = useState(0);
    const [open, setOpen] = useState(false);

    const handleClickOpen = () => {
        setOpen(true);
    };

    const handleClose = (value) => {
        setOpen(false);
    };

    const [num, setNum] = useState(1);
    const [itemToUpdate, setItemToUpdate] = useState("");
    const [productIDToUpdate, setProductIDToUpdate] = useState("");

    const updateProductQty = (id, product_id) => {
        setItemToUpdate(id);
        setProductIDToUpdate(product_id);
        setOpen(true);
    };

    const handleChange = (e) => {
        setNum(e.target.value);
    };

    const deleteItemFromCart = (rowId) => {
        Swal.fire({
            title: "¿Deseas eliminar este producto del carrito?",
            text: "Puedes guardarlo en tus favoritos para comprarlo después.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#0076bd",
            cancelButtonColor: "#dc3545",
            confirmButtonText: "Sí, eliminar del carrito.",
            cancelButtonText: "No, conservar mi producto.",
        }).then((result) => {
            if (result.value) {
                setLoading(true);

                axios
                    .post(route("deleteItemFromCart"), {
                        id: rowId,
                    })
                    .then((res) => {
                        let result = res.data;
                        toastr.success(res.data.message);
                    })
                    .catch((error) => {
                        //console.log("error");
                        //console.log(error.response);
                        toastr.error(error.response.data.message);
                    })
                    .finally(() => {
                        setLoading(false);
                        fetchData();
                    });
            }
        });
    };

    const addProductToFavorite = (slug, rowIDProduct) => {
        setLoading(true);

        axios
            .get(route("addProductToFavorite", slug))
            .then((res) => {
                let result = res.data;
                toastr.success(res.data.message);
            })
            .catch((error) => {
                //console.log("error");
                console.log(error.response.status);
                let status = error.response.status;
                if (status === 401) {
                    showUnauthenticatedDialog(rowIDProduct);
                    //usuario  no autenticado preguntar
                } else {
                    //console.log(error.response);
                    toastr.error(error.response.data.message);
                }
            })
            .finally(() => {
                setLoading(false);
            });
    };

    const updateQty = (e) => {
        console.log("itemToUpdate " + itemToUpdate);

        setLoading(true);

        axios
            .post(route("updateCartQuantity"), {
                id: itemToUpdate,
                qty: num,
                product_id: productIDToUpdate,
            })
            .then((res) => {
                let result = res.data;
                toastr.success(res.data.message);
                setOpen(false);
                fetchData();
            })
            .catch((error) => {
                //console.log("error");
                //console.log(error.response);
                toastr.error(error.response.data.message);
            })
            .finally(() => {
                setLoading(false);
            });
    };
    const formatPriceJS = (price) => {
        console.log("price");
        console.log(price);
        return price.toLocaleString("en-US", {
            style: "currency",
            currency: "USD",
            maximumFractionDigits: 0,
        });
    };

    return (
        <div>
            <LoadingOverlay
                active={loading}
                styles={{
                    overlay: (base) => ({
                        ...base,
                        background: "rgba(255, 255, 255, 0.5)",
                    }),
                }}
                spinner={<CircularProgress />}
            >
                <div className="container border-bottom py-4 mb-5">
                    <div className="row">
                        <div className="col-lg-12">
                            <div className="big-title mayus mb-4 store_title">
                                <b>
                                    CREA UN PEDIDO Y NOS CONTÁCTAREMOS CONTIGO
                                </b>
                            </div>
                        </div>
                    </div>

                    <div className="container py-4 mb-5">
                        <div className="row">
                            <div className="col-sm-6 my-2">
                                <TextField
                                    fullWidth
                                    id="outlined-basic"
                                    label="Outlined"
                                    variant="outlined"
                                />
                            </div>
                            <div className="col-sm-6 my-2">
                                <TextField
                                    fullWidth
                                    id="outlined-basic"
                                    label="Outlined"
                                    variant="outlined"
                                />
                            </div>
                            <div className="col-sm-6 my-2">
                                <TextField
                                    fullWidth
                                    id="outlined-basic"
                                    label="Outlined"
                                    variant="outlined"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </LoadingOverlay>
        </div>
    );
}

export default PedidosComponent;

if (document.getElementById("pedidos-component")) {
    const element = document.getElementById("pedidos-component");
    const props = Object.assign({}, element.dataset);
    ReactDOM.render(<PedidosComponent {...props} />, element);
}
