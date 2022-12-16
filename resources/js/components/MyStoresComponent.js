import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import List from '@mui/material/List';
import ListItem from '@mui/material/ListItem';
import ListItemText from '@mui/material/ListItemText';
import ListItemAvatar from '@mui/material/ListItemAvatar';
import Avatar from '@mui/material/Avatar';
import ModeEditOutlinedIcon from '@mui/icons-material/ModeEditOutlined';
import Divider from '@mui/material/Divider';
import HomeOutlinedIcon from '@mui/icons-material/HomeOutlined';
import { deepOrange, deepPurple } from '@mui/material/colors';
import { makeStyles } from '@mui/styles';
import DeleteIcon from '@mui/icons-material/Delete';
import IconButton from '@mui/material/IconButton';
import axios from 'axios'
import LoadingOverlay from "react-loading-overlay-ts";
import { CircularProgress, ListItemIcon } from '@mui/material'
import { Modal } from 'react-bootstrap'
import AddCircleOutlineOutlinedIcon from '@mui/icons-material/AddCircleOutlineOutlined';
import TextField from '@mui/material/TextField';
import Button from '@mui/material/Button';
import CancelOutlinedIcon from '@mui/icons-material/CancelOutlined';
import CheckBoxOutlineBlankOutlinedIcon from '@mui/icons-material/CheckBoxOutlineBlankOutlined';
import CheckBoxOutlinedIcon from '@mui/icons-material/CheckBoxOutlined';
import Tooltip from '@mui/material/Tooltip';
import FormGroup from '@mui/material/FormGroup';
import FormControlLabel from '@mui/material/FormControlLabel';
import Checkbox from '@mui/material/Checkbox';
import MenuItem from '@mui/material/MenuItem';
import './MyStoresComponent.css'
import { data } from 'jquery';
import LocationOnIcon from '@mui/icons-material/LocationOn';
import WhatsAppIconMaterial from '@mui/icons-material/WhatsApp';
import CallIcon from '@mui/icons-material/Call';
import EmailIconMaterial from '@mui/icons-material/Email';
import MuiAccordion from '@mui/material/Accordion';
import AccordionSummary from '@mui/material/AccordionSummary';
import AccordionDetails from '@mui/material/AccordionDetails';
import Typography from '@mui/material/Typography';
import ExpandMoreIcon from '@mui/icons-material/ExpandMore';
import WatchLaterOutlinedIcon from '@mui/icons-material/WatchLaterOutlined';
import { styled } from '@mui/material/styles';
import {
    EmailShareButton,
    FacebookShareButton,
    WhatsappShareButton,
    FacebookIcon,
    WhatsappIcon,
    EmailIcon
} from "react-share";
import moment from 'moment'

const Accordion = styled((props) => (
    <MuiAccordion disableGutters elevation={0} square {...props} />
))(({ theme }) => ({
    borderTop: `1px solid ${theme.palette.divider}`,
    '&:not(:last-child)': {
        //borderBottom: 0,
    },
    borderBottom: `1px solid ${theme.palette.divider}`,
    '&:before': {
        display: 'none',
    },
}));

const useStyles = makeStyles(theme => ({
    purple: {
        backgroundColor: deepPurple[500]
    },
}));

function MyStoresComponent(props) {


    //const count = useSelector((state) => state.counter.value)
    //const dispatch = useDispatch()

    //const filters = JSON.parse(props.filters)    
    const classes = useStyles();

    const [loading, setLoading] = useState(false)
    const [data, setData] = useState([])

    const fetchData = async (id) => {
        setLoading(true);

        await axios
            .get(route('get.stores.index'))
            .then(res => {
                let result = res.data;
                //console.log(result)
                setData(result)

            })
            .catch(error => {
                //console.log("error");
                //console.log(error.response);
                //toastr.error(error.response.data.message);
            })
            .finally(() => {
                setLoading(false);
            });
    };

    useEffect(() => {
        fetchData()
    }, [])


    const currentDay = moment().isoWeekday()  

    const getDateHeader = (working_days) => {
        const listItems = working_days?.map(working => {
            console.log('working')
            let workingHours = working.meta
            var index = workingHours.indexOf(workingHours.filter(function(item) { return item.day == currentDay  })[0]);
            let currentWorkingTime = workingHours[index]
           // console.log('currentWorkingTime ')
            //console.log(currentWorkingTime)
            //console.log(currentWorkingTime.time_end)

            var texto = ''

            if(currentWorkingTime.time === null || currentWorkingTime.time_end  === null ){
                //next opening ? 
                texto = <span className='text-danger'> Cerrado </span>
            }else{
                texto = <span><span className='text-success'> Abierto</span> el {getCurrentDay(currentWorkingTime.day)}. Desde {currentWorkingTime.time} Hasta {currentWorkingTime.time_end}</span>
            }

            return <div>{texto} </div>
            /*return working.meta?.map((item, index) => {
                //if(item.time !==  'undefined' && item.time_end !== 'undefined'){
                return <p><strong>{getCurrentDay(item.day)}</strong>{getTimes(item.time, item.time_end)}</p>
                //}

            })*/
        })
        


   return listItems
    }

    const getTimes = (start, end) => {
        if (start === null || end === null) {
            return <span className='text-danger'> Cerrado</span>
        }
        return ' Desde ' + start + ' Hasta ' + end

    }
    const getCurrentDay = (day) => {
        var current = '';
        if (day === 1) {
            current = 'Lun'
        } else if (day === 2) {
            current = 'Mar'
        } else if (day === 3) {
            current = 'Mie'
        } else if (day === 4) {
            current = 'Jue'
        } else if (day === 5) {
            current = 'Vie'
        } else if (day === 6) {
            current = 'Sab'
        } else if (day === 7) {
            current = 'Dom'
        } else {
        }

        return current
    }
    const _renderWorkingDays = (working_days) => {

        const listItems = working_days?.map(working => {
            return working.meta?.map((item, index) => {
                //if(item.time !==  'undefined' && item.time_end !== 'undefined'){
                return <p><strong>{getCurrentDay(item.day)}</strong>{getTimes(item.time, item.time_end)}</p>
                //}

            })
        })


        return (
            <div>{listItems}</div>
        );

    }
console.log('props')
console.log(props)
    return (
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
            <div className="container">
                <div className="row">
                    {data && data.map(item => {
                        return <div className="col-sm-4">
                            <div className="wrapper">

                                <div className="card radius shadowDepth1 custom-card">
                                    <div className="card__image border-tlr-radius">
                                        <img src={item.image_url} alt={item.name} className="border-tlr-radius"></img>
                                    </div>

                                    <div className="card__content card__padding pb-0">
                                        <div className="card__share">
                                            <div className="card__social">
                                                {/*<a className="share-icon facebook" href="#"><span className="fa fa-facebook"></span></a>*/}
                                                <a className="share-icon twitter" href="#"><span className="fa fa-twitter"></span></a>
                                                <a className="share-icon googleplus" href="#"><span className="fa fa-google-plus"></span></a>
                                            </div>

                                            {/*<a id="share" className="share-toggle share-icon" href="#"></a>*/}
                                        </div>

                                        <div className="card__meta">
                                            <a href="#">{item.name}</a>
                                            <time>{item.description}
                                                {''} {item.city ? item.city.city : null}
                                                {','} {item.state ? item.state.region : null}
                                                {','} {item.country ? item.country.country : null}
                                            </time>
                                        </div>
                                        {item.address !== null ?

                                            <article className="card__article">
                                                <div className='d-flex'>
                                                    <IconButton className='d-flex pt-0 pb-0' aria-label="location" size="large"
                                                        onClick={() => window.open(item.address_map_url, "_blank")}
                                                    >
                                                        <LocationOnIcon fontSize="large" />
                                                    </IconButton>
                                                    <p className='justify-content-center align-self-center mb-0'>{item.address}</p>
                                                </div>
                                            </article>
                                            : null}

                                        {item.phone !== null ?
                                            <article className="card__article">
                                                <div className='d-flex'>
                                                    <IconButton className='d-flex pt-0 pb-0' aria-label="location" size="large"
                                                        onClick={() =>
                                                            window.open(`tel:${item.phone}`, '_self')}
                                                    >
                                                        <CallIcon fontSize="large" />
                                                    </IconButton>
                                                    <p className='justify-content-center align-self-center mb-0'>

                                                        <a href={'tel:+57' + item.phone}>{item.phone}</a>
                                                    </p>
                                                </div>
                                            </article>
                                            : null}

                                        {item.phone_secondary !== null ?
                                            <article className="card__article">
                                                <div className='d-flex'>
                                                    <IconButton className='d-flex pt-0 pb-0' aria-label="location" size="large"
                                                        onClick={() =>
                                                            window.open(`tel:${item.phone_secondary}`, '_self')}
                                                    >
                                                        <CallIcon fontSize="large" />
                                                    </IconButton>
                                                    <p className='justify-content-center align-self-center mb-0'>

                                                        <a href={'tel:+57' + item.phone_secondary}>{item.phone_secondary}</a>
                                                    </p>
                                                </div>
                                            </article>
                                            : null}
                                        {item.whatsapp_phone !== null ?
                                    
                                            <article className="card__article">
                                                         <a className='d-flex m-2' aria-label="location" size="large"
                                           onClick={() => window.open(
                                               "https://wa.me/+57" +item.whatsapp_phone+ props.whatsapp
                                               , "_blank")}
                                       >
                                    
                                                        <WhatsAppIconMaterial fontSize="large"  className='mr-3' style={{color: 'rgba(0, 0, 0, 0.54)'}}/>
                                                    <p className='justify-content-center align-self-center mb-0'>{item.whatsapp_phone}</p>
                                                
                                                </a>

                                            </article>
                                            : null}

                                        <article className="card__article">
                                                <a className='d-flex m-2' aria-label="location" size="large"
                                                    onClick={() =>
                                                        window.open(`mailto:${item.email}`, '_self')}
                                                >
                                                                        <EmailIconMaterial fontSize="large" className='mr-3' style={{color: 'rgba(0, 0, 0, 0.54)'}}/>
                                                    <p className='justify-content-center align-self-center mb-0'>

{item.email}
</p>

                                                </a>
                                           
                                        </article>


                                    </div>

                                    <div>
                                        <Accordion>
                                            <AccordionSummary
                                                expandIcon={<ExpandMoreIcon />}
                                                aria-controls="panel1a-content"
                                                id="panel1a-header"
                                            >
                                                <WatchLaterOutlinedIcon className='mr-3' />
                                                <Typography>
                                                    {getDateHeader(item.working_days)}
                                                </Typography>
                                            </AccordionSummary>
                                            <AccordionDetails>
                                                <Typography>
                                                    {_renderWorkingDays(item.working_days)}
                                                </Typography>
                                            </AccordionDetails>
                                        </Accordion>

                                    </div>




                                    <div className="card__action text-center">
                                        <div className="card__author d-flex justify-content-between mt-2">
                                            {/*
                                            <FacebookShareButton
                                                url={item.image_url}
                                                quote={item.name}
                                            >
                                                <FacebookIcon size={32} round />
                                            </FacebookShareButton>
                                            */}
                                            {item.whatsapp_phone !== null ?

<a className='d-flex m-2' aria-label="location" size="large"
onClick={() => window.open(
    "https://wa.me/+57" +item.whatsapp_phone+ props.whatsapp
    , "_blank")}
>
                                                    <WhatsappIcon size={32} round />
                                                </a>
                                                : null}
                                            <EmailShareButton
                                                url={item.image_url}
                                                subject={item.name}
                                                body={item.name + ' ' + item.description}
                                            >
                                                <EmailIcon size={32} round />
                                            </EmailShareButton>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    })}

                </div>
            </div>
        </LoadingOverlay>
    );
}


export default MyStoresComponent;

if (document.getElementById("my-stores-component")) {
    const element = document.getElementById("my-stores-component");
    const props = Object.assign({}, element.dataset);
    ReactDOM.render(<MyStoresComponent {...props} />, element);
}

