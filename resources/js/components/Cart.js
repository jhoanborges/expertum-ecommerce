import React, { Component } from 'react';
import ReactDOM from 'react-dom';


class Cart extends Component {

    constructor (props) {
        super(props)
        this.state = {
            //name: this.props.name,
            cart:[],
            loading:true,
            qty:1,
            //last:parseInt(this.props.last),
        }
        this.setData = this.setData.bind(this)
        this.increment = this.increment.bind(this)
    }
    componentDidMount(){
        this.setData()
    }

    setData(){
        const array = Object.values(JSON.parse(this.props.cart))
        //console.log(array)
        this.setState({
            cart:array,
            loading:false
        })

    }

    increment(id, qty){

        fetch('http://localhost/clarashop/public/api/cartupdate', {
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        method: 'post',
        body: JSON.stringify( {
            id: id,
            cantidad: qty,
             } )
    })

    //cart[index] = event.target.value; // Update it with the modified email.


}

decrement(index){
    var cont = parseInt(document.getElementById(index).value) - 1
    document.getElementById(index).value = cont
}

render() {

    return (

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

      {!this.state.loading ?

        this.state.cart.map((data, index) => {
         return <tr key={data.id.toString()}>
         <td className="text-center">
         <a href="{{route('product.show' , ['product'=>$product->id ])}}">
         <img width="180" className="" src={data.image} alt=""></img>
         </a>

         </td>
         <td className="text-center" >
         <a href="{{route('product.show' , ['product'=>$product->id ])}}">

         <p className="mb-0">{data.name}</p>
         </a>
         <p className="mb-0">{data.brand} </p>
         </td>
         <td className="text-center"><i className="fas fa-check fa-2x lightgreen"></i></td>
         <td className="text-center bold black">$ {data.price}</td>
         <td className="text-center">{data.iva+' %'}</td>
         <td className="text-center">
         <div className="qty-box">

         <input type='button' value='-' className='qtyminus' field='quantity'
         onClick={()=>this.decrement(index)}/>
         <input type='text' name='quantity' value={this.state.qty} className='qty'
         id={index} onChange={()=>{} }/>

         <input type='button' value='+' className='qtyplus' field='quantity'
         onClick={()=>this.increment(data.rowId, parseInt(data.qty)+1)}/>
         </div>

         </td>
         <td className="text-center bold black">$ {data.total}</td>
         <td className="text-center"></td>
         <td className="text-center"></td>
         </tr>
     })

        :null }
        </tbody>

        </table>
        );
}
}


export default Cart

if (document.getElementById('cart-component')) {

    const component = document.getElementById('cart-component');
    const props = Object.assign({}, component.dataset);

    ReactDOM.render(<Cart {...props} />, component);
}

