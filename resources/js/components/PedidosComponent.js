import * as React from "react";
import CssBaseline from "@mui/material/CssBaseline";
import AppBar from "@mui/material/AppBar";
import Box from "@mui/material/Box";
import Container from "@mui/material/Container";
import Toolbar from "@mui/material/Toolbar";
import Paper from "@mui/material/Paper";
import Stepper from "@mui/material/Stepper";
import Step from "@mui/material/Step";
import StepLabel from "@mui/material/StepLabel";
import Button from "@mui/material/Button";
import Link from "@mui/material/Link";
import Typography from "@mui/material/Typography";
import { createTheme, ThemeProvider } from "@mui/material/styles";
import AddressForm from "./AddressForm";
import PaymentForm from "./PaymentForm";
import Review from "./Review";
import ReactDOM from "react-dom";
import Grid from "@mui/material/Grid";

import Card from "@mui/material/Card";
import CardActions from "@mui/material/CardActions";
import CardContent from "@mui/material/CardContent";
import CardMedia from "@mui/material/CardMedia";
import {
    MDBCardText,
    MDBBtn,
    MDBCard,
    MDBCardBody,
    MDBCardImage,
    MDBCol,
    MDBContainer,
    MDBIcon,
    MDBInput,
    MDBRow,
    MDBTypography,
} from "mdb-react-ui-kit";

const steps = ["General Information", "Payment details", "Review your order"];

function getStepContent(step) {
    switch (step) {
        case 0:
            return <AddressForm />;
        case 1:
            return <PaymentForm />;
        case 2:
            return <Review />;
        default:
            throw new Error("Unknown step");
    }
}

const theme = createTheme();

function PedidosComponent() {
    const [activeStep, setActiveStep] = React.useState(0);

    const handleNext = () => {
        setActiveStep(activeStep + 1);
    };

    const handleBack = () => {
        setActiveStep(activeStep - 1);
    };

    return (
        <ThemeProvider theme={theme}>
            <CssBaseline />
            <AppBar
                position="absolute"
                color="default"
                elevation={0}
                sx={{
                    position: "relative",
                    borderBottom: (t) => `1px solid ${t.palette.divider}`,
                }}
            >
                <Toolbar>
                    <Typography variant="h6" color="inherit" noWrap>
                        Crea un pedido y nos contáctaremos contigo
                    </Typography>
                </Toolbar>
            </AppBar>
            <Container component="main" maxWidth="xl" sx={{ py: 8 }}>

                    <Grid item xs={12} sm={12} md={12}>
                        <section
                            className="h-100 h-custom"
                            style={{ backgroundColor: "#eee" }}
                        >
                            <MDBContainer className="py-5 h-100">
                                <MDBRow className="justify-content-center h-100">
                                <MDBCol size="6">
                                <MDBCard
                                            className="card-registration card-registration-2 p-4"
                                            style={{ borderRadius: "15px" }}
                                        >
                            <Typography
                                component="h1"
                                variant="h4"
                                align="center"
                            >
                                Checkout
                            </Typography>
                            <Stepper
                                activeStep={activeStep}
                                sx={{ pt: 3, pb: 5 }}
                            >
                                {steps.map((label) => (
                                    <Step key={label}>
                                        <StepLabel>{label}</StepLabel>
                                    </Step>
                                ))}
                            </Stepper>
                            {activeStep === steps.length ? (
                                <React.Fragment>
                                    <Typography variant="h5" gutterBottom>
                                        Thank you for your order.
                                    </Typography>
                                    <Typography variant="subtitle1">
                                        Your order number is #2001539. We have
                                        emailed your order confirmation, and
                                        will send you an update when your order
                                        has shipped.
                                    </Typography>
                                </React.Fragment>
                            ) : (
                                <React.Fragment>
                                    {getStepContent(activeStep)}
                                    <Box
                                        sx={{
                                            display: "flex",
                                            justifyContent: "flex-end",
                                        }}
                                    >
                                        {activeStep !== 0 && (
                                            <Button
                                                onClick={handleBack}
                                                sx={{ mt: 3, ml: 1 }}
                                            >
                                                Back
                                            </Button>
                                        )}

                                        <Button
                                            variant="contained"
                                            onClick={handleNext}
                                            sx={{ mt: 3, ml: 1 }}
                                        >
                                            {activeStep === steps.length - 1
                                                ? "Place order"
                                                : "Next"}
                                        </Button>
                                    </Box>
                                </React.Fragment>
                            )}
                        </MDBCard>
                                    </MDBCol>
                                    <MDBCol size="6">
                                        <MDBCard
                                            className="card-registration card-registration-2"
                                            style={{ borderRadius: "15px" }}
                                        >
                                            <MDBCardBody className="p-0">
                                                <MDBRow className="g-0">
                                                    <MDBCol lg="12">
                                                        <div className="p-5">
                                                            <div className="d-flex justify-content-between align-items-center mb-5">
                                                                <MDBTypography
                                                                    tag="h4"
                                                                    className="fw-bold mb-0 text-black"
                                                                >
                                                                    Shopping
                                                                    Cart
                                                                </MDBTypography>
                                                                <MDBTypography className="mb-0 text-muted">
                                                                    3 items
                                                                </MDBTypography>
                                                            </div>

                                                            <hr className="my-4" />

                                                            <MDBRow className="mb-4 d-flex justify-content-between align-items-center">
                                                                <MDBCol
                                                                    md="2"
                                                                    lg="2"
                                                                    xl="2"
                                                                >
                                                                    <MDBCardImage
                                                                        src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img5.webp"
                                                                        fluid
                                                                        className="rounded-3"
                                                                        alt="Cotton T-shirt"
                                                                    />
                                                                </MDBCol>
                                                                <MDBCol
                                                                    md="3"
                                                                    lg="3"
                                                                    xl="3"
                                                                >
                                                                    <MDBTypography
                                                                        tag="h6"
                                                                        className="text-muted"
                                                                    >
                                                                        Shirt
                                                                    </MDBTypography>
                                                                    <MDBTypography
                                                                        tag="h6"
                                                                        className="text-black mb-0"
                                                                    >
                                                                        Cotton
                                                                        T-shirt
                                                                    </MDBTypography>
                                                                </MDBCol>
                                                                <MDBCol
                                                                    md="3"
                                                                    lg="3"
                                                                    xl="3"
                                                                    className="d-flex align-items-center"
                                                                >
                                                                    <MDBBtn
                                                                        color="link"
                                                                        className="px-2"
                                                                    >
                                                                        <MDBIcon
                                                                            fas
                                                                            icon="minus"
                                                                        />
                                                                    </MDBBtn>

                                                                    <MDBInput
                                                                        type="number"
                                                                        min="0"
                                                                        defaultValue={
                                                                            1
                                                                        }
                                                                        size="sm"
                                                                    />

                                                                    <MDBBtn
                                                                        color="link"
                                                                        className="px-2"
                                                                    >
                                                                        <MDBIcon
                                                                            fas
                                                                            icon="plus"
                                                                        />
                                                                    </MDBBtn>
                                                                </MDBCol>
                                                                <MDBCol
                                                                    md="3"
                                                                    lg="2"
                                                                    xl="2"
                                                                    className="text-end"
                                                                >
                                                                    <MDBTypography
                                                                        tag="h6"
                                                                        className="mb-0"
                                                                    >
                                                                        € 44.00
                                                                    </MDBTypography>
                                                                </MDBCol>
                                                                <MDBCol
                                                                    md="1"
                                                                    lg="1"
                                                                    xl="1"
                                                                    className="text-end"
                                                                >
                                                                    <a
                                                                        href="#!"
                                                                        className="text-muted"
                                                                    >
                                                                        <MDBIcon
                                                                            fas
                                                                            icon="times"
                                                                        />
                                                                    </a>
                                                                </MDBCol>
                                                            </MDBRow>

                                                            <hr className="my-4" />

                                                            <MDBRow className="mb-4 d-flex justify-content-between align-items-center">
                                                                <MDBCol
                                                                    md="2"
                                                                    lg="2"
                                                                    xl="2"
                                                                >
                                                                    <MDBCardImage
                                                                        src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img6.webp"
                                                                        fluid
                                                                        className="rounded-3"
                                                                        alt="Cotton T-shirt"
                                                                    />
                                                                </MDBCol>
                                                                <MDBCol
                                                                    md="3"
                                                                    lg="3"
                                                                    xl="3"
                                                                >
                                                                    <MDBTypography
                                                                        tag="h6"
                                                                        className="text-muted"
                                                                    >
                                                                        Shirt
                                                                    </MDBTypography>
                                                                    <MDBTypography
                                                                        tag="h6"
                                                                        className="text-black mb-0"
                                                                    >
                                                                        Cotton
                                                                        T-shirt
                                                                    </MDBTypography>
                                                                </MDBCol>
                                                                <MDBCol
                                                                    md="3"
                                                                    lg="3"
                                                                    xl="3"
                                                                    className="d-flex align-items-center"
                                                                >
                                                                    <MDBBtn
                                                                        color="link"
                                                                        className="px-2"
                                                                    >
                                                                        <MDBIcon
                                                                            fas
                                                                            icon="minus"
                                                                        />
                                                                    </MDBBtn>

                                                                    <MDBInput
                                                                        type="number"
                                                                        min="0"
                                                                        defaultValue={
                                                                            1
                                                                        }
                                                                        size="sm"
                                                                    />

                                                                    <MDBBtn
                                                                        color="link"
                                                                        className="px-2"
                                                                    >
                                                                        <MDBIcon
                                                                            fas
                                                                            icon="plus"
                                                                        />
                                                                    </MDBBtn>
                                                                </MDBCol>
                                                                <MDBCol
                                                                    md="3"
                                                                    lg="2"
                                                                    xl="2"
                                                                    className="text-end"
                                                                >
                                                                    <MDBTypography
                                                                        tag="h6"
                                                                        className="mb-0"
                                                                    >
                                                                        € 44.00
                                                                    </MDBTypography>
                                                                </MDBCol>
                                                                <MDBCol
                                                                    md="1"
                                                                    lg="1"
                                                                    xl="1"
                                                                    className="text-end"
                                                                >
                                                                    <a
                                                                        href="#!"
                                                                        className="text-muted"
                                                                    >
                                                                        <MDBIcon
                                                                            fas
                                                                            icon="times"
                                                                        />
                                                                    </a>
                                                                </MDBCol>
                                                            </MDBRow>

                                                            <hr className="my-4" />

                                                            <MDBRow className="mb-4 d-flex justify-content-between align-items-center">
                                                                <MDBCol
                                                                    md="2"
                                                                    lg="2"
                                                                    xl="2"
                                                                >
                                                                    <MDBCardImage
                                                                        src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img7.webp"
                                                                        fluid
                                                                        className="rounded-3"
                                                                        alt="Cotton T-shirt"
                                                                    />
                                                                </MDBCol>
                                                                <MDBCol
                                                                    md="3"
                                                                    lg="3"
                                                                    xl="3"
                                                                >
                                                                    <MDBTypography
                                                                        tag="h6"
                                                                        className="text-muted"
                                                                    >
                                                                        Shirt
                                                                    </MDBTypography>
                                                                    <MDBTypography
                                                                        tag="h6"
                                                                        className="text-black mb-0"
                                                                    >
                                                                        Cotton
                                                                        T-shirt
                                                                    </MDBTypography>
                                                                </MDBCol>
                                                                <MDBCol
                                                                    md="3"
                                                                    lg="3"
                                                                    xl="3"
                                                                    className="d-flex align-items-center"
                                                                >
                                                                    <MDBBtn
                                                                        color="link"
                                                                        className="px-2"
                                                                    >
                                                                        <MDBIcon
                                                                            fas
                                                                            icon="minus"
                                                                        />
                                                                    </MDBBtn>

                                                                    <MDBInput
                                                                        type="number"
                                                                        min="0"
                                                                        defaultValue={
                                                                            1
                                                                        }
                                                                        size="sm"
                                                                    />

                                                                    <MDBBtn
                                                                        color="link"
                                                                        className="px-2"
                                                                    >
                                                                        <MDBIcon
                                                                            fas
                                                                            icon="plus"
                                                                        />
                                                                    </MDBBtn>
                                                                </MDBCol>
                                                                <MDBCol
                                                                    md="3"
                                                                    lg="2"
                                                                    xl="2"
                                                                    className="text-end"
                                                                >
                                                                    <MDBTypography
                                                                        tag="h6"
                                                                        className="mb-0"
                                                                    >
                                                                        € 44.00
                                                                    </MDBTypography>
                                                                </MDBCol>
                                                                <MDBCol
                                                                    md="1"
                                                                    lg="1"
                                                                    xl="1"
                                                                    className="text-end"
                                                                >
                                                                    <a
                                                                        href="#!"
                                                                        className="text-muted"
                                                                    >
                                                                        <MDBIcon
                                                                            fas
                                                                            icon="times"
                                                                        />
                                                                    </a>
                                                                </MDBCol>
                                                            </MDBRow>

                                                            <hr className="my-4" />

                                                            <div className="pt-5">
                                                                <MDBTypography
                                                                    tag="h6"
                                                                    className="mb-0"
                                                                >
                                                                    <MDBCardText
                                                                        tag="a"
                                                                        href="#!"
                                                                        className="text-body"
                                                                    >
                                                                        <MDBIcon
                                                                            fas
                                                                            icon="long-arrow-alt-left me-2"
                                                                        />{" "}
                                                                        Back to
                                                                        shop
                                                                    </MDBCardText>
                                                                </MDBTypography>
                                                            </div>
                                                        </div>
                                                    </MDBCol>
                                                </MDBRow>
                                            </MDBCardBody>
                                        </MDBCard>
                                    </MDBCol>
                                </MDBRow>
                            </MDBContainer>
                        </section>
                   </Grid>

            </Container>
        </ThemeProvider>
    );
}

export default PedidosComponent;

if (document.getElementById("pedidos-component")) {
    const element = document.getElementById("pedidos-component");
    const props = Object.assign({}, element.dataset);
    ReactDOM.render(<PedidosComponent {...props} />, element);
}
