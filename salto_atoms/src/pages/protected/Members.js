import { useEffect } from 'react'
import { useDispatch } from 'react-redux'
import { setPageTitle } from '../../features/common/headerSlice'
import Members from '../../features/members/index'

function InternalPage(){
    const dispatch = useDispatch()

    useEffect(() => {
        dispatch(setPageTitle({ title : "SALTO図鑑"}))
      }, [])


    return(
        <Members />
    )
}

export default InternalPage