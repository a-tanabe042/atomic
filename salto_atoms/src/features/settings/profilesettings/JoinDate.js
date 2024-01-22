import React from 'react';
import { useRecoilState } from "recoil";
import { joinDateState } from "../../../state";
import Datepicker from "react-tailwindcss-datepicker";

const JoinDate = () => {
    const [joinDate, setJoinDate] = useRecoilState(joinDateState,{ 
        startDate: null ,
        endDate: null 
        }); 
        
        const handleValueChange = (newValue) => {
        setJoinDate(newValue); 
        } 
        
        return (
        <Datepicker 
        useRange={false} 
        asSingle={true} 
        value={joinDate} 
        onChange={handleValueChange} 
        /> 
        );
}

export default JoinDate;
