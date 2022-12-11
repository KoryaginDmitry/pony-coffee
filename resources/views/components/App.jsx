import React from 'react'
import GuestPage from '../../js/page/GuestPage'
import AdminPage from '../../js/page/AdminPage'
import UserPage from '../../js/page/UserPage'
import BaristaPage from '../../js/page/BaristaPage'

const App = () => {

  const status = 'barista'
  const render = () => {
      switch(status) {
      case 'admin' : 
        return <AdminPage/>;
      case 'guest' : 
        return <GuestPage/>;
      case 'user' : 
        return <UserPage/>
      case 'barista' : 
        return <BaristaPage/>;
      default: <GuestPage/>;
      
    }
  }

  return (
    <>
      {render()}
    </>
  )
}

export default App
