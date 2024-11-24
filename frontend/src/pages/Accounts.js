import axios from "axios";
import Table from 'react-bootstrap/Table';
import { useEffect, useState } from "react";
function Accounts() {
    const [accounts, setaccounts] = useState([]);
    
    //use effect is required for calling api not in the components
    useEffect(()=>{
        axios.get("http://localhost:8000/api/data")
        .then((response) => {
            setaccounts((previousState) => { //recoommend to use arrow function beause of updating in state
                return response.data;
            })
        })
        .catch((err) => {
            console.log(`Error`, err)
        })
    },[])
   
    return <>
    <div style={{paddingTop:"100px"}}></div>
   <Table xs={1} md={3} className="g-3">
  <thead>
    <tr>
      <th>ID</th>
      {[
        "Last Name",
        "First Name",
        "Age",
        "Address",
        "Email"
      ].map((heading, index) => {
        return <th key={index}>{heading}</th>; 
      })}
    </tr>
  </thead>
  <tbody>
    {accounts.map((acc, rowIndex) => (
      <tr key={rowIndex}>
        <td>{rowIndex + 1}</td>
        <td>{acc.last_name}</td>
        <td>{acc.first_name}</td>
        <td>{acc.age}</td>
        <td>{acc.address}</td>
        <td>{acc.email}</td>
      </tr>
    ))}
  </tbody>
</Table>

    </>
}
export default Accounts;