import { useEffect } from 'react'
import { setPageTitle } from '../../features/common/headerSlice'
import Members from '../../features/members/index'

function InternalPage(){

    useEffect(() => {
        setPageTitle({ title : "Salto図鑑"})
      }, [])


    return(
        <Members />
    )
}

export default InternalPage