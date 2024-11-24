import axios from "axios";
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
    </>
}
export default Accounts;