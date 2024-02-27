import { useEffect } from 'react'
import Charts from '../../features/charts'
import { setPageTitle } from '../../features/common/headerSlice'

function InternalPage(){
    useEffect(() => {
        setPageTitle({ title : "Analytics"})
      }, [])
    return(
        <Charts />
    )
}

export default InternalPage